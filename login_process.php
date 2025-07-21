<?php
session_start();
include 'includes/koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
        // Simpan data ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Arahkan ke halaman sesuai role
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } elseif ($user['role'] == 'customer') {
            header("Location: user_dashboard.php");
        } else {
            echo "Role tidak dikenali.";
        }
        exit();
    } else {
        echo "Password salah.";
    }
} else {
    echo "Email tidak ditemukan.";
}
?>
