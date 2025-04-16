<?php
session_start();
require "functions.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

 if (isset($_POST["submit"])) {
    if (tambahData($_POST)) {
        echo "<script>alert('Data berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Population Census System</title>
    <!-- Menggunakan CDN Tailwind CSS yang benar -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-chart-bar text-2xl mr-2"></i>
                        <span class="font-bold text-xl">Population Census System</span>
                    </div>
                </div>
                <div class="flex items-center">
                    <span class="mr-4">Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></span>
                    <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded transition duration-300">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Data Entry Form</h1>
            
            <?php if(isset($_POST["submit"]) && tambahData($_POST)): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>Data successfully added!</p>
                </div>
            <?php elseif(isset($_POST["submit"])): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>Failed to add data. Please try again.</p>
                </div>
            <?php endif; ?>
            
            <form action="" method="post" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-gray-700 text-sm font-medium mb-2">Full Name:</label>
                        <input type="text" name="nama" id="nama" placeholder="Enter full name" required
                            class="shadow-sm appearance-none border rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email Address:</label>
                        <input type="email" name="email" id="email" placeholder="Enter email address" required
                            class="shadow-sm appearance-none border rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500">
                    </div>
                </div>
                
                <div>
                    <label for="alamat" class="block text-gray-700 text-sm font-medium mb-2">Address:</label>
                    <input type="text" name="alamat" id="alamat" placeholder="Enter full address" required
                        class="shadow-sm appearance-none border rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500">
                </div>
                
                <div class="flex space-x-4 pt-4">
                    <button type="submit" name="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md focus:outline-none focus:shadow-outline transition duration-300">
                        <i class="fas fa-save mr-2"></i>Submit Data
                    </button>
                </div>
            </form>
        </div>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Resident Data Registry</h2>
            
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-3 px-6 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">No</th>
                            <th class="py-3 px-6 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Name</th>
                            <th class="py-3 px-6 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Email</th>
                            <th class="py-3 px-6 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Address</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php
                        $datawarga = ambildata();
                        $no = 1;
                        foreach($datawarga as $row):
                        ?>
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-6 border-b border-gray-200"><?= $no++; ?></td>
                            <td class="py-4 px-6 border-b border-gray-200"><?= htmlspecialchars($row["Nama"]); ?></td>
                            <td class="py-4 px-6 border-b border-gray-200"><?= htmlspecialchars($row["email"]); ?></td>
                            <td class="py-4 px-6 border-b border-gray-200"><?= htmlspecialchars($row["Alamat"]); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-center">
                <p>© 2025 Population Census System. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>