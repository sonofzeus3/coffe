<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - Coffee Haven</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-amber-800 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-mug-hot text-amber-300 text-2xl mr-3"></i>
                <h1 class="text-2xl font-bold">Coffee Haven</h1>
            </div>
            <nav>
                <ul class="flex space-x-6 items-center">
                    <li>
                        <span class="text-amber-200">Selamat datang, <?php echo htmlspecialchars($_SESSION['name']); ?></span>
                    </li>
                    <li>
                        <a href="logout.php" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-10">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-amber-800 mb-6">Dashboard Pelanggan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-amber-100 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-amber-800 mb-2">Pesanan Terakhir</h3>
                    <p class="text-gray-700">Anda belum memiliki pesanan</p>
                    <a href="#" class="mt-4 inline-block text-amber-600 hover:text-amber-800 font-medium">
                        Lihat Riwayat Pesanan <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                <div class="bg-amber-100 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-amber-800 mb-2">Favorit Anda</h3>
                    <p class="text-gray-700">Anda belum memiliki menu favorit</p>
                    <a href="#" class="mt-4 inline-block text-amber-600 hover:text-amber-800 font-medium">
                        Lihat Menu <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                <div class="bg-amber-100 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold text-amber-800 mb-2">Poin Hadiah</h3>
                    <p class="text-3xl font-bold text-amber-600">0</p>
                    <p class="text-gray-700">Poin tersedia</p>
                </div>
            </div>
            
            <div class="bg-amber-50 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-amber-800 mb-4">Rekomendasi Untuk Anda</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="border border-amber-200 rounded-lg p-4">
                        <div class="bg-amber-200 h-40 rounded mb-3 flex items-center justify-center">
                            <i class="fas fa-coffee text-amber-600 text-4xl"></i>
                        </div>
                        <h4 class="font-semibold">Ethiopian Black</h4>
                        <p class="text-sm text-gray-600 mb-2">Rp 25.000</p>
                        <button class="w-full bg-amber-600 hover:bg-amber-700 text-white py-2 rounded text-sm">
                            Pesan Sekarang
                        </button>
                    </div>
                    <div class="border border-amber-200 rounded-lg p-4">
                        <div class="bg-amber-200 h-40 rounded mb-3 flex items-center justify-center">
                            <i class="fas fa-coffee text-amber-600 text-4xl"></i>
                        </div>
                        <h4 class="font-semibold">Honeycomb Latte</h4>
                        <p class="text-sm text-gray-600 mb-2">Rp 35.000</p>
                        <button class="w-full bg-amber-600 hover:bg-amber-700 text-white py-2 rounded text-sm">
                            Pesan Sekarang
                        </button>
                    </div>
                    <div class="border border-amber-200 rounded-lg p-4">
                        <div class="bg-amber-200 h-40 rounded mb-3 flex items-center justify-center">
                            <i class="fas fa-coffee text-amber-600 text-4xl"></i>
                        </div>
                        <h4 class="font-semibold">Cinnamon Cappuccino</h4>
                        <p class="text-sm text-gray-600 mb-2">Rp 32.000</p>
                        <button class="w-full bg-amber-600 hover:bg-amber-700 text-white py-2 rounded text-sm">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-amber-900 text-white py-6 mt-10">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; <?php echo date("Y"); ?> Coffee Haven. Semua hak dilindungi.</p>
            <div class="mt-2">
                <a href="#" class="text-amber-300 hover:text-white mx-2">Kebijakan Privasi</a>
                <a href="#" class="text-amber-300 hover:text-white mx-2">Syarat & Ketentuan</a>
                <a href="#" class="text-amber-300 hover:text-white mx-2">Kontak Kami</a>
            </div>
        </div>
    </footer>

</body>
</html>