<?php
session_start();
require_once 'functions.php';

if(isset($_SESSION["user_id"])){
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (login($username, $password)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Population Census System</title>
        <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-blue-600 px-6 py-8">
            <h1 class="text-white text-3xl font-bold text-center">Population Census</h1>
            <p class="text-blue-200 text-center mt-2">Official Data Collection System</p>
        </div>
        
        <div class="p-8">
            <?php if(isset($error)): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p><?= $error ?></p>
                </div>
            <?php endif; ?>
            
            <form action="" method="post">
                <div class="mb-6">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" name="username" id="username" required 
                           class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500">
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" required 
                           class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500">
                </div>
                
                <div class="flex items-center justify-between">
                    <button type="submit" name="login" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline w-full transition duration-300">
                        Login
                    </button>
                </div>
            </form>
        </div>
        
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-200 flex justify-center">
            <p class="text-sm text-gray-600">Population Census System © 2025</p>
        </div>
    </div>
</body>
</html>