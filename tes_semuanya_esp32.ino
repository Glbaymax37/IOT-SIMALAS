#include <WiFi.h>
#include <HTTPClient.h>
#include <EEPROM.h>
#include <PZEM004Tv30.h>
#include <DHT.h>
#include <LiquidCrystal_I2C.h>

#define CNT_PIN 7  // Pin GPIO untuk counter
#define DHTPIN 4    // Pin GPIO untuk DHT11
#define DHTTYPE DHT11
#define SSR_PIN 2   // Pin GPIO untuk SSR

const char* ssid = "Pro";
const char* password = "12345678";
const char* server_url = "http://192.168.145.223";  // Ubah ini ke URL server Anda

#if defined(ESP32)
/*************************
 *  ESP32 initialization
 * ---------------------
 * 
 * The ESP32 HW Serial interface can be routed to any GPIO pin 
 * Here we initialize the PZEM on Serial2 with RX/TX pins 16 and 17
 */
#if !defined(PZEM_RX_PIN) && !defined(PZEM_TX_PIN)
#define PZEM_RX_PIN 1
#define PZEM_TX_PIN 3
#endif

#define PZEM_SERIAL Serial2
#define CONSOLE_SERIAL Serial
PZEM004Tv30 pzem(PZEM_SERIAL, PZEM_RX_PIN, PZEM_TX_PIN);
#endif

DHT dht(DHTPIN, DHTTYPE);
LiquidCrystal_I2C lcd(0x27, 16, 2);
WiFiClient wifiClient;
HTTPClient http;

float Dia = 0.03286;  // Diameter roda counter (dalam meter)
int CPR = 10;  // Jumlah pickup pada roda counter
float FullRoll = 330.0;  // Panjang standar satu spool filament (dalam meter)
float Remaining = 330.0;  // Panjang filament yang tersisa
float Used = 0.0, OldUsed = 0.0;
float LowLevelLimit = 5.0;  // Batas panjang filament rendah

long newPosition = 0;
long oldPosition = -999;
long Click = 0;
unsigned long LowTime = 0;
unsigned long LowLevelAlarm = 0;

bool ssrState = false;  // Status SSR, false = OFF, true = ON
bool Saved = false;
bool Started = false;
bool Low = false;
bool LowLevel = false;
bool LevelLimit = false;

void DrawHeader() {
  lcd.clear();
  lcd.setCursor(3, 0);
  lcd.print("Mesin 3D Print");
}

void setup() {
  Serial.begin(115200);
    EEPROM.begin(512); // Sesuaikan ukuran sesuai kebutuhan

  WiFi.begin(ssid, password);
  pinMode(CNT_PIN, INPUT_PULLUP);
  pinMode(SSR_PIN, OUTPUT);
  digitalWrite(SSR_PIN, LOW);
  
  dht.begin();
  lcd.init();
  lcd.backlight();
  DrawHeader();
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");

  // Begin SoftwareSerial for PZEM communication
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
    float tegangan = pzem.voltage();
    float arus = pzem.current();
    float daya = pzem.power();
    float energi = pzem.energy();
    float suhu = dht.readTemperature();
    float kelembapan = dht.readHumidity();

    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Tegangan: ");
    lcd.print(tegangan);
    lcd.print(" V");
    lcd.setCursor(0, 1);
    lcd.print("Arus: ");
    lcd.print(arus);
    lcd.print(" A");
    delay(2000);

    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Energi: ");
    lcd.print(energi);
    delay(2000);

    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Suhu: ");
    lcd.print(suhu);
    lcd.setCursor(0, 1);
    lcd.print("Kelembapan: ");
    lcd.print(kelembapan);
    delay(2000);

    Serial.print("Tegangan: ");
    Serial.print(tegangan);
    Serial.println(" V");
    Serial.print("Arus: ");
    Serial.print(arus);
    Serial.println(" A");
    Serial.print("Daya: ");
    Serial.print(daya);
    Serial.println(" W");
    Serial.print("Energi: ");
    Serial.print(energi);
    Serial.println(" kWh");
    Serial.print("Suhu: ");
    Serial.print(suhu);
    Serial.println(" C");
    Serial.print("Kelembapan: ");
    Serial.print(kelembapan);
    Serial.println(" %");

    if ((Used - OldUsed) > 1.0) {
      OldUsed = Used;
      EEPROM.put(0, Remaining);
    }
    if (digitalRead(CNT_PIN) == LOW) {
      LowTime = millis();
      Low = true;
    }
    if (Low && (digitalRead(CNT_PIN) == HIGH)) {
      if (millis() - LowTime > 1000) {
        Started = true;
        Low = false;
        LowTime = millis();
        Click++;
        Used += (Dia * 3.1415927) / CPR;
        Remaining -= (Dia * 3.1415927) / CPR;
        lcd.clear();
        lcd.setCursor(0, 1);
        lcd.print("Used: ");
        lcd.print(Used, 2);
        delay(2000);
        lcd.clear();
        lcd.setCursor(0, 1);
        lcd.print("Sisa Filament: ");
        lcd.print(Remaining, 2);
        delay(2000);
        Serial.print("Panjang Filament yang Digunakan: ");
        Serial.print(Used, 2);
        Serial.println(" meter");
        Serial.print("Panjang Filament yang Tersisa: ");
        Serial.print(Remaining, 2);
        Serial.println(" meter");
      }
    }

    if (!isnan(tegangan) && !isnan(arus) && !isnan(daya) && !isnan(energi) && !isnan(suhu) && !isnan(kelembapan)) {
      String postData = "tegangan=" + String(tegangan) + "&arus=" + String(arus) + "&daya=" + String(daya) + "&energi=" + String(energi) + "&suhu=" + String(suhu) + "&kelembapan=" + String(kelembapan) + "&used=" + String(Used, 2) + "&remaining=" + String(Remaining, 2);

      Serial.println("POST Data: " + postData);

      http.begin(wifiClient, String(server_url) + "/IOT-SIMALAS/IOT-SIMALAS/HARDWARE/submit_data.php");
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");
      int httpResponseCode = http.POST(postData);

      Serial.print("HTTP Response Code: ");
      Serial.println(httpResponseCode);

      if (httpResponseCode > 0) {
        String response = http.getString();
        Serial.println("Response: " + response);
      } else {
        Serial.println("Error on sending POST: " + String(httpResponseCode));
      }
      http.end();
    }

    http.begin(wifiClient, String(server_url) + "/iot/get_ssr_status.php");
    int httpResponseCode = http.GET();
    if (httpResponseCode > 0) {
      String ssrStatus = http.getString();
      if (ssrStatus == "ON") {
        digitalWrite(SSR_PIN, HIGH);
        Serial.println("SSR ON");
      } else {
        digitalWrite(SSR_PIN, LOW);
        Serial.println("SSR OFF");
      }
    }
    http.end();
  }

  delay(1000);
}
