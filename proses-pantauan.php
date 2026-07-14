<?php
// Wajib sertakan koneksi database
require_once 'koneksi.php';

// Atur header response agar mengeluarkan format JSON (supaya bisa dibaca oleh JavaScript Frontend)
header('Content-Type: application/json');

// Pastikan request datang menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Tangkap data dari FormData JavaScript
    $nama_lokasi   = isset($_POST['nama_lokasi']) ? trim($_POST['nama_lokasi']) : null;
    $latitude      = isset($_POST['latitude']) ? trim($_POST['latitude']) : null;
    $longitude     = isset($_POST['longitude']) ? trim($_POST['longitude']) : null;
    $bulan_hijriah = isset($_POST['bulan_hijriah']) ? trim($_POST['bulan_hijriah']) : null;
    $tanggal_masehi= isset($_POST['tanggal_masehi']) ? trim($_POST['tanggal_masehi']) : null;

    // Skenario simulasi User ID (Misal: AbidBima12 yang sedang login memiliki ID 1)
    $user_id = 1; 

    // 2. Validasi sederhana, pastikan data krusial tidak kosong
    if (empty($nama_lokasi) || empty($latitude) || empty($longitude) || empty($bulan_hijriah)) {
        echo json_encode([
            'success' => false,
            'message' => 'Gagal menyimpan! Semua kolom kustom wajib diisi.'
        ]);
        exit;
    }

    try {
        // A. MASUKKAN LOKASI BARU KE TABEL `lokasi_observasi`
        $sql_lokasi = "INSERT INTO lokasi_observasi (nama_lokasi, provinsi, kabupaten_kota, latitude, longitude) 
                       VALUES (:nama_lokasi, 'Kustom', 'Kustom', :latitude, :longitude)";
        
        $stmt_lokasi = $pdo->prepare($sql_lokasi);
        $stmt_lokasi->execute([
            ':nama_lokasi' => $nama_lokasi,
            ':latitude'    => $latitude,
            ':longitude'   => $longitude
        ]);
        
        // Ambil ID lokasi yang baru saja masuk otomatis
        $new_lokasi_id = $pdo->lastInsertId();

        // B. MASUKKAN RENCANA PEMANTAUAN KE TABEL `rencana_pemantauan`
        $sql_rencana = "INSERT INTO rencana_pemantauan (user_id, lokasi_id, bulan_hijriah, tahun_hijriah, tanggal_masehi, status_rencana) 
                        VALUES (:user_id, :lokasi_id, :bulan_hijriah, :tahun_hijriah, :tanggal_masehi, 'Disetujui')";
        
        $stmt_rencana = $pdo->prepare($sql_rencana);
        $stmt_rencana->execute([
            ':user_id'        => $user_id,
            ':lokasi_id'      => $new_lokasi_id,
            ':bulan_hijriah'  => $bulan_hijriah,
            ':tahun_hijriah'  => 1448, // Sesuai data Safar 1448H
            ':tanggal_masehi' => $tanggal_masehi
        ]);

        // 3. Berikan respon sukses ke Frontend
        echo json_encode([
            'success' => true,
            'message' => "Sukses! Rencana pemantauan di '{$namaLokasi}' berhasil disimpan ke MySQL Laragon."
        ]);

    } catch (PDOException $e) {
        // Jika ada error pada query SQL
        echo json_encode([
            'success' => false,
            'message' => 'Terjadi kesalahan database: ' . $e->getMessage()
        ]);
    }

} else {
    // Jika diakses langsung tanpa form POST
    echo json_encode([
        'success' => false,
        'message' => 'Metode akses ditolak.'
    ]);
}

?>
