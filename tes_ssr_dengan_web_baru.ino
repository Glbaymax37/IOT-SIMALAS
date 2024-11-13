#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

// Gantilah dengan informasi jaringan WiFi Anda
const char* ssid = "Pro";
const char* password = "12345678";
const char* server_url = "http://192.168.80.83"; // Gantilah dengan URL server Anda

// Pin untuk SSR
#define SSR_PIN 12 // pin D6
bool ssrState = false; // Status SSR
WiFiClient wifiClient;

void setup() {
  Serial.begin(115200);
  pinMode(SSR_PIN, OUTPUT);
  digitalWrite(SSR_PIN, LOW); // Mematikan SSR di awal

  // Menghubungkan ke WiFi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("Connected to WiFi");
}

void loop() {
  // Membaca status dari server
  readStatusFromServer();

  delay(1000); // Tunggu 1 detik sebelum loop berikutnya
}

// Fungsi untuk mengirim status ke server
void sendStatusToServer() {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(wifiClient, String(server_url) + "/aiot/IOT-SIMALAS/startbootstrap-sb-admin-2-gh-pages/update_ssr_status.php");
    
    // Mengirimkan permintaan POST dengan status
    http.addHeader("Content-Type", "application/x-www-form-urlencoded"); // Menambahkan header
    String postData = "status=" + String(ssrState ? "ON" : "OFF"); // Mengatur data yang akan dikirim

    int httpResponseCode = http.POST(postData); // Menggunakan POST
    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println("Response: " + response);
      
      // Memproses respons dari server
      if (response.indexOf("success") >= 0) {
        Serial.println("Status berhasil dikirim ke server.");
      } else {
        Serial.println("Gagal mengirim status ke server.");
      }
    } else {
      Serial.println("Error on sending POST: " + String(httpResponseCode));
    }
    http.end();
  }
}

// Fungsi untuk membaca status dari server
void readStatusFromServer() {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(wifiClient, String(server_url) + "/aiot/IOT-SIMALAS/startbootstrap-sb-admin-2-gh-pages/get_ssr_status.php"); // Endpoint untuk mendapatkan status

    int httpResponseCode = http.GET(); // Menggunakan GET untuk membaca status
    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println("Response: " + response);
      
      // Proses respons untuk mendapatkan status
      if (response.indexOf("ON") >= 0) {
        ssrState = true;
        digitalWrite(SSR_PIN, HIGH); // Menghidupkan SSR
      } else {
        ssrState = false;
        digitalWrite(SSR_PIN, LOW); // Mematikan SSR
      }
    } else {
      Serial.println("Error on sending GET: " + String(httpResponseCode));
    }
    http.end();
  }
}
