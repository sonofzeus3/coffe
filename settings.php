<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki peran admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Arahkan ke halaman login jika tidak memiliki akses
    exit();
}

// Menghubungkan ke database
require 'includes/koneksi.php';

// Menangani pengaturan yang disimpan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $store_name = $_POST['store_name'];
    $store_address = $_POST['store_address'];
    $store_phone = $_POST['store_phone'];
    $store_email = $_POST['store_email'];

    // Simpan pengaturan ke database (ganti dengan query yang sesuai)
    $query = "UPDATE settings SET store_name='$store_name', store_address='$store_address', store_phone='$store_phone', store_email='$store_email' WHERE id=1";
    mysqli_query($conn, $query);
}

// Ambil pengaturan dari database
$query = "SELECT * FROM settings WHERE id=1"; // Ganti dengan nama tabel yang sesuai
$result = mysqli_query($conn, $query);
$settings = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - CoffeeShop</title>
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
            <h1 class="text-3xl font-bold mb-5">Pengaturan Toko</h1>

            <form action="settings.php" method="POST" class="bg-white p-5 rounded shadow">
                <div class="mb-4">
                    <label for="store_name" class="block text-gray-700">Nama Toko</label>
                    <input type="text" name="store_name" id="store_name" value="<?php echo $settings['store_name']; ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="store_address" class="block text-gray-700">Alamat Toko</label>
                    <input type="text" name="store_address" id="store_address" value="<?php echo $settings['store_address']; ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="store_phone" class="block text-gray-700">Nomor Telepon</label>
                    <input type="text" name="store_phone" id="store_phone" value="<?php echo $settings['store_phone']; ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="store_email" class="block text-gray-700">Email Kontak</label>
                    <input type="email" name="store_email" id="store_email" value="<?php echo $settings['store_email']; ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Pengaturan</button>
            </form>
        </div>
    </div>

</body>
</html>
