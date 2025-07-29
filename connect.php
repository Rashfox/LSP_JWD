<!-- 
    Author  : Rizki Fajar Purnomo
    Version : 1.0 
-->
<?php
// connect.php

$host = 'localhost'; // Host database kamu, biasanya localhost
$dbname = 'beasiswa'; // Nama database yang akan kamu gunakan
$username = 'root'; // Username database kamu
$password = ''; // Password database kamu (kosong jika tidak ada)

try {
    // Membuat koneksi PDO (PHP Data Objects)
    // PDO ini lebih modern dan aman dibanding mysql_connect() atau mysqli_connect() biasa
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set mode error PDO ke exception agar mudah menangani error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "Koneksi database berhasil!"; // Ini bisa di-komen setelah memastikan koneksi berhasil
} catch (PDOException $e) {
    // Jika koneksi gagal, tampilkan pesan error
    die("Koneksi database gagal: " . $e->getMessage());
}
?>