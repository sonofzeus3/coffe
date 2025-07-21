<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki peran admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Menghubungkan ke database
require 'includes/koneksi.php';

// Ambil data yang diperlukan untuk dashboard
$query = "SELECT COUNT(*) as total_users FROM users";
$result = mysqli_query($conn, $query);
$total_users = mysqli_fetch_assoc($result)['total_users'];

$query = "SELECT SUM(total_price) as total_sales FROM orders";
$result = mysqli_query($conn, $query);
$total_sales = mysqli_fetch_assoc($result)['total_sales'] ?? 0;

// Ambil data untuk grafik (contoh: penjualan 7 hari terakhir)
$query = "SELECT DATE(created_at) as date, SUM(total_price) as daily_sales 
          FROM orders 
          WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
          GROUP BY DATE(created_at) 
          ORDER BY DATE(created_at)";
$sales_data = mysqli_query($conn, $query);
$chart_labels = [];
$chart_values = [];
while ($row = mysqli_fetch_assoc($sales_data)) {
    $chart_labels[] = date('d M', strtotime($row['date']));
    $chart_values[] = $row['daily_sales'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Coffee Haven</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        }
        .stat-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .active-nav {
            background-color: rgba(245, 158, 11, 0.2);
            border-left: 4px solid #f59e0b;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar text-white w-64 min-h-screen p-5 flex flex-col">
            <div class="flex items-center justify-center mb-8">
                <div class="bg-amber-500 p-2 rounded-lg mr-3">
                    <i class="fas fa-mug-hot text-white text-xl"></i>
                </div>
                <h1 class="text-xl font-bold bg-gradient-to-r from-amber-400 to-amber-600 bg-clip-text text-transparent">
                    Coffee Haven
                </h1>
            </div>
            
            <div class="flex items-center mb-8 p-3 bg-gray-700 rounded-lg">
                <div class="bg-amber-500 rounded-full w-10 h-10 flex items-center justify-center mr-3">
                    <span class="text-white font-semibold"><?php echo substr($_SESSION['name'] ?? 'A', 0, 1); ?></span>
                </div>
                <div>
                    <p class="font-medium"><?php echo htmlspecialchars($_SESSION['name'] ?? 'Admin'); ?></p>
                    <p class="text-xs text-gray-300">Administrator</p>
                </div>
            </div>
            
            <nav class="flex-1">
                <ul>
                    <li class="mb-2">
                        <a href="admin_dashboard.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200 active-nav">
                            <i class="fas fa-tachometer-alt mr-3 text-amber-400"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="menu_list.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200">
                            <i class="fas fa-utensils mr-3 text-blue-400"></i>
                            <span>Manajemen Menu</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="order_list.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200">
                            <i class="fas fa-receipt mr-3 text-green-400"></i>
                            <span>Manajemen Pesanan</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="user_list.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200">
                            <i class="fas fa-users mr-3 text-purple-400"></i>
                            <span>Manajemen Pengguna</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="sales_report.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200">
                            <i class="fas fa-chart-line mr-3 text-red-400"></i>
                            <span>Laporan Penjualan</span>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="settings.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200">
                            <i class="fas fa-cog mr-3 text-indigo-400"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="mt-auto">
                <a href="logout.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200">
                    <i class="fas fa-sign-out-alt mr-3 text-gray-400"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <i class="fas fa-bell text-gray-500 hover:text-amber-500 cursor-pointer"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                        </div>
                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                            <span class="text-sm font-medium"><?php echo substr($_SESSION['name'] ?? 'A', 0, 1); ?></span>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="stat-card bg-white rounded-xl p-6 border-l-4 border-amber-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 font-medium">Total Pengguna</p>
                                <h3 class="text-3xl font-bold mt-2"><?php echo $total_users; ?></h3>
                            </div>
                            <div class="bg-amber-100 p-3 rounded-lg">
                                <i class="fas fa-users text-amber-500 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-green-500">
                            <i class="fas fa-arrow-up mr-1"></i>
                            <span>12% dari bulan lalu</span>
                        </div>
                    </div>
                    
                    <div class="stat-card bg-white rounded-xl p-6 border-l-4 border-blue-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 font-medium">Total Penjualan</p>
                                <h3 class="text-3xl font-bold mt-2">Rp <?php echo number_format($total_sales, 0, ',', '.'); ?></h3>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-lg">
                                <i class="fas fa-shopping-cart text-blue-500 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-green-500">
                            <i class="fas fa-arrow-up mr-1"></i>
                            <span>8% dari bulan lalu</span>
                        </div>
                    </div>
                    
                    <div class="stat-card bg-white rounded-xl p-6 border-l-4 border-green-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 font-medium">Pesanan Hari Ini</p>
                                <h3 class="text-3xl font-bold mt-2">24</h3>
                            </div>
                            <div class="bg-green-100 p-3 rounded-lg">
                                <i class="fas fa-receipt text-green-500 text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center text-sm text-red-500">
                            <i class="fas fa-arrow-down mr-1"></i>
                            <span>2% dari kemarin</span>
                        </div>
                    </div>
                </div>
                
                <!-- Sales Chart -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Grafik Penjualan 7 Hari Terakhir</h2>
                        <select class="bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                            <option>Minggu Ini</option>
                            <option>Bulan Ini</option>
                            <option>Tahun Ini</option>
                        </select>
                    </div>
                    <div class="h-80">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
                
                <!-- Recent Orders -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Pesanan Terbaru</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-001</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">John Doe</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 75.000</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Selesai
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12 Jun 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-amber-600 hover:text-amber-900 mr-3">Detail</a>
                                        <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-002</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jane Smith</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 120.000</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Proses
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">11 Jun 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-amber-600 hover:text-amber-900 mr-3">Detail</a>
                                        <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#ORD-003</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Robert Johnson</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 65.000</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Baru
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10 Jun 2023</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="#" class="text-amber-600 hover:text-amber-900 mr-3">Detail</a>
                                        <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Sales Chart
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($chart_labels); ?>,
                datasets: [{
                    label: 'Total Penjualan',
                    data: <?php echo json_encode($chart_values); ?>,
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    borderColor: 'rgba(245, 158, 11, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>