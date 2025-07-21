<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki peran admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Arahkan ke halaman login jika tidak memiliki akses
    exit();
}

// Menghubungkan ke database
require 'includes/koneksi.php';

// Ambil semua penjualan
$query = "SELECT * FROM orders"; // Ganti dengan nama tabel yang sesuai
$result = mysqli_query($conn, $query);
$sales = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Menghitung total penjualan dan jumlah pesanan
$total_sales = 0;
$total_orders = count($sales);
foreach ($sales as $sale) {
    $total_sales += $sale['total_price']; // Pastikan kolom total_price ada di tabel orders
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - CoffeeShop</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-gradient-to-b from-gray-800 to-gray-900 text-white w-64 flex-shrink-0 transform -translate-x-full md:translate-x-0 transition-transform duration-150 ease-in">
            <div class="sidebar-content px-4 py-6">
                <h1 class="text-2xl font-bold mb-8 flex items-center space-x-2">
                    <i class="fas fa-coffee text-amber-400"></i>
                    <span>CoffeeShop Admin</span>
                </h1>
                <ul class="space-y-2">
                    <li>
                        <a href="admin_dashboard.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors">
                            <i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="menu_list.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors">
                            <i class="fas fa-utensils mr-3 w-5 text-center"></i>
                            <span>Manajemen Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="order_list.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart mr-3 w-5 text-center"></i>
                            <span>Manajemen Pesanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_list.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors">
                            <i class="fas fa-users mr-3 w-5 text-center"></i>
                            <span>Manajemen Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="sales_report.php" class="flex items-center p-3 text-white bg-gray-700 rounded-lg">
                            <i class="fas fa-chart-line mr-3 w-5 text-center"></i>
                            <span>Laporan Penjualan</span>
                        </a>
                    </li>
                    <li>
                        <a href="settings.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors">
                            <i class="fas fa-cog mr-3 w-5 text-center"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                    <li class="mt-8 pt-4 border-t border-gray-700">
                        <a href="logout.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-colors">
                            <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="p-8">
                <!-- Header -->
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Laporan Penjualan</h1>
                        <p class="text-gray-600">Ringkasan lengkap penjualan CoffeeShop</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                            <i class="fas fa-download mr-2"></i>
                            <span>Export PDF</span>
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                            <i class="fas fa-print mr-2"></i>
                            <span>Print</span>
                        </button>
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 font-medium">Total Penjualan</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">Rp <?php echo number_format($total_sales, 2, ',', '.'); ?></h3>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-wallet text-blue-500"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-3"><span class="text-green-500 font-medium">+12%</span> dari bulan lalu</p>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 font-medium">Jumlah Pesanan</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1"><?php echo $total_orders; ?></h3>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-shopping-bag text-green-500"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-3"><span class="text-green-500 font-medium">+8%</span> dari bulan lalu</p>
                    </div>

                    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 font-medium">Rata-rata per Pesanan</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-1">Rp <?php echo number_format($total_orders > 0 ? $total_sales / $total_orders : 0, 2, ',', '.'); ?></h3>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-chart-pie text-purple-500"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-3"><span class="text-green-500 font-medium">+5%</span> dari bulan lalu</p>
                    </div>
                </div>

                <!-- Sales Table -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">Daftar Transaksi</h2>
                        <div class="relative">
                            <input type="text" placeholder="Cari transaksi..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php 
                                $no = 1; // Inisialisasi nomor urut
                                foreach ($sales as $sale): 
                                    $statusClass = $sale['payment_status'] === 'paid' ? 'bg-green-100 text-green-800' : ($sale['payment_status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800');
                                ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $no++; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#<?php echo $sale['id']; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo $sale['customer_name']; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp <?php echo number_format($sale['total_price'], 2, ',', '.'); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full <?php echo $statusClass; ?>">
                                                <?php echo ucfirst($sale['payment_status']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $sale['created_at']; ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="#" class="text-blue-500 hover:text-blue-700 mr-3"><i class="fas fa-eye"></i></a>
                                            <a href="#" class="text-green-500 hover:text-green-700"><i class="fas fa-print"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium"><?php echo count($sales); ?></span> dari <span class="font-medium"><?php echo count($sales); ?></span> transaksi
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                Sebelumnya
                            </button>
                            <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                Selanjutnya
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>