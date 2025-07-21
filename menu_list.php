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
    if (isset($_POST['add_menu'])) {
        // Tambah menu
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];

        // Upload image
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);

        $query = "INSERT INTO menus (name, price, description, image) VALUES ('$name', '$price', '$description', '$image')";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['update_menu'])) {
        // Update menu
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];

        // Jika ada gambar baru, upload
        if ($image) {
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
            $query = "UPDATE menus SET name='$name', price='$price', description='$description', image='$image' WHERE id='$id'";
        } else {
            $query = "UPDATE menus SET name='$name', price='$price', description='$description' WHERE id='$id'";
        }
        mysqli_query($conn, $query);
    } elseif (isset($_POST['delete_menu'])) {
        // Hapus menu
        $id = $_POST['id'];
        $query = "DELETE FROM menus WHERE id='$id'";
        mysqli_query($conn, $query);
    }
}

// Ambil semua menu
$query = "SELECT * FROM menus";
$result = mysqli_query($conn, $query);
$menus = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Menu - CoffeeShop</title>
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
            <h1 class="text-3xl font-bold mb-5">Manajemen Menu</h1>

            <!-- Form Tambah/Edit Menu -->
            <form action="menu_list.php" method="POST" enctype="multipart/form-data" class="mb-5">
                <input type="hidden" name="id" id="menu_id">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nama Menu</label>
                    <input type="text" name="name" id="name" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700">Harga</label>
                    <input type="number" name="price" id="price" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" class="mt-1 block w-full p-2 border border-gray-300 rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700">Gambar Menu</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                </div>
                <button type="submit" name="add_menu" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Menu</button>
                <button type="submit" name="update_menu" class="bg-green-500 text-white px-4 py-2 rounded hidden" id="update_button">Update Menu</button>
            </form>

            <!-- Tabel Daftar Menu -->
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">No</th> <!-- Ubah nama kolom menjadi No -->
                        <th class="py-2 px-4 border-b">Nama Menu</th>
                        <th class="py-2 px-4 border-b">Harga</th>
                        <th class="py-2 px-4 border-b">Deskripsi</th>
                        <th class="py-2 px-4 border-b">Gambar</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; // Inisialisasi nomor urut
                    foreach ($menus as $menu): ?>
                        <tr>
                            <td class="py-2 px-4 border-b"><?php echo $no++; ?></td> <!-- Tampilkan nomor urut -->
                            <td class="py-2 px-4 border-b"><?php echo $menu['name']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $menu['price']; ?></td>
                            <td class="py-2 px-4 border-b"><?php echo $menu['description']; ?></td>
                            <td class="py-2 px-4 border-b">
                                <?php if ($menu['image']): ?>
                                    <img src="uploads/<?php echo $menu['image']; ?>" alt="<?php echo $menu['name']; ?>" class="w-20 h-20 object-cover">
                                <?php endif; ?>
                            </td>
                            <td class="py-2 px-4 border-b flex justify-start">
                                <button 
                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition duration-200" 
                                    onclick="editMenu(<?php echo $menu['id']; ?>, '<?php echo $menu['name']; ?>', <?php echo $menu['price']; ?>, '<?php echo $menu['description']; ?>', '<?php echo $menu['image']; ?>')">
                                    Edit
                                </button>
                                <form action="menu_list.php" method="POST" class="inline ml-2">
                                    <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
                                    <button 
                                        type="submit" 
                                        name="delete_menu" 
                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition duration-200">
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
        function editMenu(id, name, price, description, image) {
            document.getElementById('menu_id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('price').value = price;
            document.getElementById('description').value = description;
            document.getElementById('update_button').classList.remove('hidden');
            document.querySelector('button[name="add_menu"]').classList.add('hidden');
        }
    </script>

</body>
</html>
