<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "sensus_penduduk";

$conn = mysqli_connect($host, $user, $password, $db);

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}

function tambahData($data) {
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "INSERT INTO data_warga (Nama, email, Alamat) 
              VALUES ('$nama', '$email', '$alamat')";
    
    return mysqli_query($conn, $query);
}

function ambildata(){
    global $conn;
    $query = "SELECT * FROM data_warga";
    $result = mysqli_query($conn,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function login($username,$password){
    global $conn;

    $username = mysqli_real_escape_string($conn,$username);
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn,$query);

    if($result && mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            return true;
        }
        return false;
    }
}
?>