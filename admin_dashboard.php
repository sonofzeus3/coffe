<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki peran admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Arahkan ke halaman login jika tidak memiliki akses
    exit();
}

// Menghubungkan ke database
require 'includes/config.php';

// Ambil data yang diperlukan untuk dashboard
$query = "SELECT COUNT(*) as total_users FROM users";
$result = mysqli_query($conn, $query);
$total_users = mysqli_fetch_assoc($result)['total_users'];

$query = "SELECT SUM(total_price) as total_sales FROM orders"; // Ganti dengan nama tabel yang sesuai
$result = mysqli_query($conn, $query);
$total_sales = mysqli_fetch_assoc($result)['total_sales'] ?? 0; // Menghindari error jika tidak ada penjualan
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - CoffeeShop</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">

    <div class="flex">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 min-h-screen p-5">
            <h1 class="text-2xl font-bold mb-5 text-center">CoffeeShop Admin</h1>
            <ul>
                <li class="mb-3">
                    <a href="admin_dashboard.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded transition duration-200">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                </li>
                <li class="mb-3">
                    <a href="menu_list.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded transition duration-200">
                        <i class="fas fa-utensils mr-3"></i>
                        Manajemen Menu
                    </a>
                </li>
                <li class="mb-3">
                    <a href="order_list.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded transition duration-200">
                        <i class="fas fa-receipt mr-3"></i>
                        Manajemen Pesanan
                    </a>
                </li>
                <li class="mb-3">
                    <a href="user_list.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded transition duration-200">
                        <i class="fas fa-users mr-3"></i>
                        Manajemen Pengguna
                    </a>
                </li>
                <li class="mb-3">
                    <a href="sales_report.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded transition duration-200">
                        <i class="fas fa-chart-line mr-3"></i>
                        Laporan Penjualan
                    </a>
                </li>
                <li class="mb-3">
                    <a href="settings.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded transition duration-200">
                        <i class="fas fa-cog mr-3"></i>
                        Pengaturan
                    </a>
                </li>
                <li class="mb-3">
                    <a href="logout.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded transition duration-200">
                        <i class="fas fa-sign-out-alt mr-3"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <h1 class="text-3xl font-bold mb-5">Dashboard Admin</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded shadow">
                    <h2 class="text-xl font-semibold">Total Pengguna</h2>
                    <p class="text-3xl"><?php echo $total_users; ?></p>
                </div>
                <div class="bg-white p-5 rounded shadow">
                    <h2 class="text-xl font-semibold">Total Penjualan</h2>
                    <p class="text-3xl">Rp <?php echo number_format($total_sales, 2, ',', '.'); ?></p>
                </div>
                <div class="bg-white p-5 rounded shadow">
                    <h2 class="text-xl font-semibold">Statistik Lainnya</h2>
                    <p class="text-3xl">Data Tambahan</p>
                </div>
            </div>

            <div class="mt-10">
                <h2 class="text-2xl font-bold mb-4">Grafik Penjualan</h2>
                <div class="bg-white p-5 rounded shadow">
                    <!-- Tempat untuk grafik penjualan -->
                    <p>Grafik penjualan akan ditampilkan di sini.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-10">
        <div class="container mx-auto text-center">
            <p>&copy; <?php echo date("Y"); ?> Kedai Kopi ABC. Semua hak dilindungi.</p>
            <p>
                <a href="privacy_policy.php" class="text-gray-400 hover:text-white">Kebijakan Privasi</a> | 
                <a href="contact.php" class="text-gray-400 hover:text-white">Kontak</a>
            </p>
        </div>
    </footer>

</body>
</html>
