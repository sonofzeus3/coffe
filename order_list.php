<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki peran admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Arahkan ke halaman login jika tidak memiliki akses
    exit();
}

// Menghubungkan ke database
require 'includes/config.php';

// Ambil semua pesanan
$query = "SELECT * FROM orders"; // Ganti dengan nama tabel yang sesuai
$result = mysqli_query($conn, $query);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - CoffeeShop</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar bg-gray-800 text-white w-64 min-h-screen p-5">
            <h1 class="text-2xl font-bold mb-5">CoffeeShop Admin</h1>
            <ul>
                <li class="mb-3">
                    <a href="admin_dashboard.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                        Dashboard
                    </a>
                </li>
                <li class="mb-3">
                    <a href="menu_list.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                        Manajemen Menu
                    </a>
                </li>
                <li class="mb-3">
                    <a href="order_list.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                        Manajemen Pesanan
                    </a>
                </li>
                <li class="mb-3">
                    <a href="user_list.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                        Manajemen Pengguna
                    </a>
                </li>
                <li class="mb-3">
                    <a href="sales_report.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                        Laporan Penjualan
                    </a>
                </li>
                <li class="mb-3">
                    <a href="settings.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                        Pengaturan
                    </a>
                </li>
                <li class="mb-3">
                    <a href="logout.php" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <h1 class="text-3xl font-bold mb-5">Manajemen Pesanan</h1>

            <!-- Tabel Daftar Pesanan -->
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">No</th>
                        <th class="py-2 px-4 border-b">ID Pesanan</th>
                        <th class="py-2 px-4 border-b">Nama Pelanggan</th>
                        <th class="py-2 px-4 border-b">Total Harga</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Tanggal</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; // Inisialisasi nomor urut
                    foreach ($orders as $order): ?>
                        <tr>
                            <td class="py-2 px-4 border-b"><?php echo $no++; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $order['id']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $order['customer_name']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $order['total_price']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $order['status']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $order['created_at']; ?></td>
                            <td class="py-2 px-4 border-b">
                                <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition duration-200">Edit</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition duration-200 ml-2">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
