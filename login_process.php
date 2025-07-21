<?php
session_start();

// Menghubungkan ke database
require 'includes/config.php'; // Menggunakan file config dari folder includes

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memeriksa pengguna
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // Memeriksa apakah pengguna ada dan password cocok
    if ($user && password_verify($password, $user['password'])) {
        // Cek apakah pengguna adalah admin
        if ($user['role'] === 'admin') {
            // Set session dan arahkan ke dashboard admin
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = 'admin';
            header('Location: admin_dashboard.php');
            exit();
        } else {
            // Set session untuk pengguna biasa
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = 'customer';
            header('Location: user_dashboard.php'); // Halaman untuk pengguna biasa
            exit();
        }
    } else {
        // Jika login gagal
        echo "Email atau password salah.";
    }
}
?>
