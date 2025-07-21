<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki peran admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); // Arahkan ke halaman login jika tidak memiliki akses
    exit();
}

// Menghubungkan ke database
require 'includes/koneksi.php';

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="sidebar bg-gradient-to-b from-gray-800 to-gray-900 text-white w-64 flex-shrink-0 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out">
            <div class="p-5">
                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-2xl font-bold">
                        <span class="text-amber-400">Coffee</span>Shop
                    </h1>
                </div>
                <nav>
                    <ul class="space-y-2">
                        <li>
                            <a href="admin_dashboard.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="menu_list.php" class="flex items-center p-3 bg-gray-700 text-white rounded-lg">
                                <i class="fas fa-utensils mr-3"></i>
                                Manajemen Menu
                            </a>
                        </li>
                        <li>
                            <a href="order_list.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200">
                                <i class="fas fa-clipboard-list mr-3"></i>
                                Manajemen Pesanan
                            </a>
                        </li>
                        <li>
                            <a href="user_list.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200">
                                <i class="fas fa-users mr-3"></i>
                                Manajemen Pengguna
                            </a>
                        </li>
                        <li>
                            <a href="sales_report.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200">
                                <i class="fas fa-chart-line mr-3"></i>
                                Laporan Penjualan
                            </a>
                        </li>
                        <li>
                            <a href="settings.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200">
                                <i class="fas fa-cog mr-3"></i>
                                Pengaturan
                            </a>
                        </li>
                        <li class="pt-4 mt-4 border-t border-gray-700">
                            <a href="logout.php" class="flex items-center p-3 text-gray-300 hover:bg-gray-700 rounded-lg transition duration-200">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <div class="p-6 md:p-10">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Manajemen Menu</h1>
                        <p class="text-gray-600">Kelola daftar menu coffee shop Anda</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <button onclick="resetForm()" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-plus mr-2"></i>Tambah Menu Baru
                        </button>
                    </div>
                </div>

                <!-- Form Tambah/Edit Menu -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">
                        <span id="form-title">Tambah Menu Baru</span>
                    </h2>
                    <form action="menu_list.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="menu_id">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Menu</label>
                                <input type="text" name="name" id="name" required 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200">
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                                    <input type="number" name="price" id="price" required 
                                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200">
                                </div>
                            </div>
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                <textarea name="description" id="description" rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200"></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Menu</label>
                                <div class="flex items-center">
                                    <div class="relative flex-1">
                                        <input type="file" name="image" id="image" 
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition duration-200">
                                    </div>
                                    <div id="image-preview" class="ml-4 w-16 h-16 bg-gray-100 rounded-lg overflow-hidden hidden">
                                        <img id="preview-img" src="" alt="Preview" class="w-full h-full object-cover">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex space-x-3">
                            <button type="submit" name="add_menu" id="add_button"
                                class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2 rounded-lg transition duration-200">
                                <i class="fas fa-save mr-2"></i>Simpan Menu
                            </button>
                            <button type="submit" name="update_menu" id="update_button"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition duration-200 hidden">
                                <i class="fas fa-sync-alt mr-2"></i>Update Menu
                            </button>
                            <button type="button" onclick="resetForm()"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition duration-200">
                                <i class="fas fa-times mr-2"></i>Batal
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tabel Daftar Menu -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Menu</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php 
                                $no = 1;
                                foreach ($menus as $menu): ?>
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo $no++; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900"><?php echo $menu['name']; ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Rp<?php echo number_format($menu['price'], 0, ',', '.'); ?></div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500 max-w-xs truncate"><?php echo $menu['description']; ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($menu['image']): ?>
                                                <img src="uploads/<?php echo $menu['image']; ?>" alt="<?php echo $menu['name']; ?>" 
                                                    class="w-12 h-12 rounded-md object-cover shadow-sm">
                                            <?php else: ?>
                                                <div class="w-12 h-12 bg-gray-100 rounded-md flex items-center justify-center">
                                                    <i class="fas fa-image text-gray-400"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <button 
                                                    onclick="editMenu(<?php echo $menu['id']; ?>, '<?php echo addslashes($menu['name']); ?>', <?php echo $menu['price']; ?>, '<?php echo addslashes($menu['description']); ?>', '<?php echo $menu['image']; ?>')"
                                                    class="text-blue-600 hover:text-blue-900 transition duration-200">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="menu_list.php" method="POST" class="inline">
                                                    <input type="hidden" name="id" value="<?php echo $menu['id']; ?>">
                                                    <button 
                                                        type="submit" 
                                                        name="delete_menu" 
                                                        class="text-red-600 hover:text-red-900 transition duration-200"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editMenu(id, name, price, description, image) {
            document.getElementById('menu_id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('price').value = price;
            document.getElementById('description').value = description;
            
            // Update form title
            document.getElementById('form-title').textContent = 'Edit Menu';
            
            // Show update button and hide add button
            document.getElementById('update_button').classList.remove('hidden');
            document.getElementById('add_button').classList.add('hidden');
            
            // Scroll to form
            document.querySelector('form').scrollIntoView({ behavior: 'smooth' });
        }
        
        function resetForm() {
            document.getElementById('menu_id').value = '';
            document.getElementById('name').value = '';
            document.getElementById('price').value = '';
            document.getElementById('description').value = '';
            document.getElementById('image').value = '';
            
            // Reset form title
            document.getElementById('form-title').textContent = 'Tambah Menu Baru';
            
            // Show add button and hide update button
            document.getElementById('add_button').classList.remove('hidden');
            document.getElementById('update_button').classList.add('hidden');
            
            // Hide image preview
            document.getElementById('image-preview').classList.add('hidden');
        }
        
        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(e) {
            const preview = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');
            
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                preview.classList.add('hidden');
            }
        });
    </script>

</body>
</html>