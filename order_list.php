<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki peran admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Arahkan ke halaman login jika tidak memiliki akses
    exit();
}

// Menghubungkan ke database
require 'includes/koneksi.php';

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-gradient-to-b from-gray-800 to-gray-900 text-white w-64 min-h-screen p-5 flex flex-col">
            <div class="flex items-center mb-8">
                <i class="fas fa-coffee text-2xl mr-3 text-amber-400"></i>
                <h1 class="text-2xl font-bold">CoffeeShop Admin</h1>
            </div>
            
            <nav class="flex-1">
                <ul class="space-y-2">
                    <li>
                        <a href="admin_dashboard.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-all duration-200">
                            <i class="fas fa-tachometer-alt mr-3 w-5 text-center"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="menu_list.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-all duration-200">
                            <i class="fas fa-utensils mr-3 w-5 text-center"></i>
                            Manajemen Menu
                        </a>
                    </li>
                    <li>
                        <a href="order_list.php" class="flex items-center p-3 bg-gray-700 text-white rounded-lg">
                            <i class="fas fa-clipboard-list mr-3 w-5 text-center"></i>
                            Manajemen Pesanan
                        </a>
                    </li>
                    <li>
                        <a href="user_list.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-all duration-200">
                            <i class="fas fa-users mr-3 w-5 text-center"></i>
                            Manajemen Pengguna
                        </a>
                    </li>
                    <li>
                        <a href="sales_report.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-all duration-200">
                            <i class="fas fa-chart-line mr-3 w-5 text-center"></i>
                            Laporan Penjualan
                        </a>
                    </li>
                    <li>
                        <a href="settings.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-all duration-200">
                            <i class="fas fa-cog mr-3 w-5 text-center"></i>
                            Pengaturan
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="mt-auto pt-4 border-t border-gray-700">
                <a href="logout.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition-all duration-200">
                    <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i>
                    Logout
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="px-8 py-4 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">
                        <i class="fas fa-clipboard-list text-amber-500 mr-3"></i>
                        Manajemen Pesanan
                    </h1>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Cari pesanan..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-300">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                        <button class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Pesanan
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="p-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Total Pesanan</p>
                                <h3 class="text-2xl font-bold mt-1"><?php echo count($orders); ?></h3>
                            </div>
                            <div class="bg-amber-100 p-3 rounded-lg">
                                <i class="fas fa-shopping-bag text-amber-500"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Pesanan Baru</p>
                                <h3 class="text-2xl font-bold mt-1">12</h3>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <i class="fas fa-clock text-blue-500"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Dalam Proses</p>
                                <h3 class="text-2xl font-bold mt-1">8</h3>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-lg">
                                <i class="fas fa-spinner text-purple-500"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm">Selesai</p>
                                <h3 class="text-2xl font-bold mt-1">24</h3>
                            </div>
                            <div class="bg-green-100 p-3 rounded-lg">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-semibold text-gray-800">Daftar Pesanan Terbaru</h3>
                        <div class="flex space-x-3">
                            <select class="border rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-amber-300">
                                <option>Semua Status</option>
                                <option>Baru</option>
                                <option>Dalam Proses</option>
                                <option>Selesai</option>
                            </select>
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-filter"></i>
                            </button>
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-download"></i>
                            </button>
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
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php 
                                $no = 1;
                                foreach ($orders as $order): 
                                    // Determine status color
                                    $statusColor = 'bg-gray-100 text-gray-800';
                                    if ($order['status'] == 'Selesai') {
                                        $statusColor = 'bg-green-100 text-green-800';
                                    } elseif ($order['status'] == 'Dalam Proses') {
                                        $statusColor = 'bg-blue-100 text-blue-800';
                                    } elseif ($order['status'] == 'Dibatalkan') {
                                        $statusColor = 'bg-red-100 text-red-800';
                                    }
                                ?>
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $no++; ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">#<?php echo $order['id']; ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-amber-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-amber-500"></i>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900"><?php echo $order['customer_name']; ?></div>
                                                <div class="text-sm text-gray-500"><?php echo substr($order['created_at'], 0, 10); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-medium">Rp <?php echo number_format($order['total_price'], 0, ',', '.'); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $statusColor; ?>">
                                            <?php echo $order['status']; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo date('d M Y H:i', strtotime($order['created_at'])); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-amber-600 hover:text-amber-900 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium"><?php echo count($orders); ?></span> hasil
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 border rounded-lg text-gray-500 hover:bg-gray-50">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="px-3 py-1 border rounded-lg bg-amber-500 text-white">1</button>
                            <button class="px-3 py-1 border rounded-lg text-gray-700 hover:bg-gray-50">2</button>
                            <button class="px-3 py-1 border rounded-lg text-gray-500 hover:bg-gray-50">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>