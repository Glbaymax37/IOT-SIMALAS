<!DOCTYPE html>
<html lang="en">
<body>
    <h1>Assignment 1 RE506 Web Aplikasi</h1>
    <h2>1.Variable String, List, Dictionary, Integer</h2>

    <!-- Variabel String -->
    <h3>Variabel String</h3>
    <?php
    $greeting = "Selamat Datang di Web Sederhana Saya!";?>
    <p><?php echo $greeting; ?></p>
    <hr>

    <!-- Menampilkan variabel list -->
    <h3>Menampilkan variabel list</h3> 
    <?php
    $fruits = ["Apel", "Pisang", "Jeruk"];?>
    <p>Daftar Buah:</p>
    <ul>
        <?php
        foreach ($fruits as $fruit) {
            echo "<li>$fruit</li>";
        }
        ?>
    </ul>
    <hr>

    <!-- Menampilkan Variabel Dictionary -->
    <h3> Menampilkan Variabel Dictionary </h3>
    <?php
    $person = 
    [   "nama" => "Abdi Wijaya Sasmita",
        "NIM" => "4222201044",
        "umur" => 21, // Ubah umur sesuai kebutuhan untuk menguji kondisi if-else
        "hobby" => "Main Futsal"];?>
    <h4>Informasi Pribadi:</h4>
    <p>Nama: <?php echo $person["nama"]; ?></p>
    <p>NIM: <?php echo $person["NIM"]; ?></p>
    <p>Umur: <?php echo $person["umur"]; ?> tahun</p>
    <p>Hobby: <?php echo $person["hobby"]; ?></p>
    <hr>

    <h3>Menampilkan Variabel Integer</h3> 
    <?php
    // Variabel Integer
    $year = 2024;
    ?>
    <p>Tahun: <?php echo $year; ?></p>
    <hr>

    <h2>2. if-else</h2>
    <h3>Menampilkan Pesan Berdasarkan Kondisi if-else</h3> 
    <?php
    $message = "";
    if ($person["umur"] < 18) {
        $message = "ANAK ANAK.";
    } elseif ($person["umur"] >= 18 && $person["umur"] <= 30) {
        $message = "REMAJA.";
    }
    elseif ($person['umur'] >= 30) {
        $message = "OM OM";
    }
    ?>
    <p>Pesan: <?php echo $message; ?></p>
    <hr>

    <h2>3. Loop</h2>
    <?php
    for ($i = 1; $i <= 5; $i++) {
        echo "Nomor: $i<br>";
    }
    ?>
    <hr>
    <h2>4. Function</h2>
    <?php
    function Kuadrat($angka) {
        return $angka * $angka;
    }
    $angka = 10;
    echo "Kuadrat dari $angka adalah " . Kuadrat($angka) . ".";
    ?>
    <hr>

    <h2>5. Form</h2>
    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" value="Kirim">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = htmlspecialchars($_POST['nama']);
        echo "<p>Email yang dimasukkan: $email</p>";
    }
    ?>
    <hr>

    <h2>6. Hyperlink</h2>
    <a href="https://www.instagram.com/abdi_w.s/"target="_blank">Kunjungi instagram Saya</a>
    <br>

</body>
</html>