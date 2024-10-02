<?php
session_start(); 
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "simalas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil semua data dari tabel users
$sql = "SELECT userid, NIM, PBL,NAMA FROM user";
$result = $conn->query($sql);
?>