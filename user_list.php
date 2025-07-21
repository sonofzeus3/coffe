<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki peran admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Arahkan ke halaman login jika tidak memiliki akses
    exit();
}

// Menghubungkan ke database
require 'includes/config.php';

// Menangani operasi CRUD
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_user'])) {
        // Hapus pengguna
        $id = $_POST['id'];
        $query = "DELETE FROM users WHERE id='$id'";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['update_user'])) {
        // Update pengguna
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $status = $_POST['status'];

        $query = "UPDATE users SET name='$name', email='$email', role='$role', status='$status' WHERE id='$id'";
        mysqli_query($conn, $query);
    }
}

// Ambil semua pengguna
$query = "SELECT * FROM users"; // Ganti dengan nama tabel yang sesuai
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - CoffeeShop</title>
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
            <h1 class="text-3xl font-bold mb-5">Manajemen Pengguna</h1>

            <!-- Form untuk Edit Pengguna -->
            <form action="user_list.php" method="POST" class="mb-5" id="editForm" style="display: none;">
                <input type="hidden" name="id" id="user_id">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nama Pengguna</label>
                    <input type="text" name="name" id="name" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-700">Peran</label>
                    <input type="text" name="role" id="role" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                        <option value="aktif">Aktif</option>
                        <option value="tidak aktif">Tidak Aktif</option>
                    </select>
                </div>
                <button type="submit" name="update_user" class="bg-green-500 text-white px-4 py-2 rounded">Update Pengguna</button>
            </form>

            <!-- Tabel Daftar Pengguna -->
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">No</th>
                        <th class="py-2 px-4 border-b">ID Pengguna</th>
                        <th class="py-2 px-4 border-b">Nama Pengguna</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Peran</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Tanggal Bergabung</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; // Inisialisasi nomor urut
                    foreach ($users as $user): ?>
                        <tr>
                            <td class="py-2 px-4 border-b"><?php echo $no++; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $user['id']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $user['name']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $user['email']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $user['role']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $user['status']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $user['created_at']; ?></td>
                            <td class="py-2 px-4 border-b">
                                <button 
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition duration-200" 
                                    onclick="editUser (<?php echo $user['id']; ?>, '<?php echo $user['name']; ?>', '<?php echo $user['email']; ?>', '<?php echo $user['role']; ?>', '<?php echo $user['status']; ?>')">
                                    Edit
                                </button>
                                <form action="user_list.php" method="POST" class="inline">
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <button 
                                        type="submit" 
                                        name="delete_user" 
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition duration-200 ml-2">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function editUser (id, name, email, role, status) {
            document.getElementById('user_id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('email').value = email;
            document.getElementById('role').value = role;
            document.getElementById('status').value = status;
            document.getElementById('editForm').style.display = 'block';
        }
    </script>

</body>
</html>
