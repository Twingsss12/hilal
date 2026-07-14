<?php
// Konfigurasi database MySQL Laragon
$host     = 'localhost';
$db_name  = 'pemantauan_hilal_ldii';
$username = 'root';
$password = ''; // Default Laragon dikosongkan

try {
    // Membuat koneksi PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    
    // Mengatur mode error PDO ke Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // Jika koneksi gagal, hentikan skrip dan tampilkan pesan
    die("Koneksi database gagal: " || $e->getMessage());
}
?>