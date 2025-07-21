<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Arahkan ke halaman login jika tidak memiliki akses
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna - CoffeeShop</title>
    <link rel="stylesheet" href="path/to/tailwind.css"> <!-- Ganti dengan path yang sesuai -->
</head>
<body>
    <h1>Selamat datang di Dashboard Pengguna</h1>
    <p>Ini adalah halaman untuk pengguna biasa.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
