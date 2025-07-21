<?php
session_start();

// Menghubungkan ke database
require 'includes/config.php'; // Menggunakan file config dari folder includes

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash password

    // Cek jumlah pengguna yang sudah terdaftar
    $query = "SELECT COUNT(*) as count FROM users";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $user_count = $row['count'];

    // Jika ini adalah pengguna pertama, set role sebagai admin
    $role = ($user_count == 0) ? 'admin' : 'customer';

    // Query untuk menyimpan pengguna baru
    $insert_query = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', '$role')";
    
    if (mysqli_query($conn, $insert_query)) {
        // Pendaftaran berhasil
        echo "Pendaftaran berhasil. Anda sekarang dapat login.";
        header('Location: login.php'); // Arahkan ke halaman login setelah pendaftaran
        exit();
    } else {
        // Jika ada kesalahan saat menyimpan
        echo "Error: " . mysqli_error($conn);
    }
}
?>
