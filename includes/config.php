<?php
// File Konfigurasi Database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'coffeeshop';

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
