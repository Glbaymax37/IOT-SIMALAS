<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "simalas";

// Membuat koneksi ke database
$connection = mysqli_connect($host, $username, $password, $db);

// Memeriksa apakah koneksi berhasil
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Data yang akan dimasukkan
$Nama = "cukii";
$NIM = "4222201044";
$PBL = "IOT Simalas";

// Query SQL untuk memasukkan data ke tabel 'user'
$query = "INSERT INTO user (Nama, NIM,PBL) VALUES ('$Nama', '$NIM','$PBL')";

// Menjalankan query dan memeriksa apakah berhasil
if (mysqli_query($connection, $query)) {
    echo "Data berhasil dimasukkan.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}

// Menutup koneksi
mysqli_close($connection);

?>
