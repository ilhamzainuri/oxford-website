<?php
include '../../db-connection/koneksi.php';

// Set header untuk JSON response
header('Content-Type: application/json');

// Ambil ID fakultas dari parameter GET
$id_fakultas = $_GET['id_fakultas'] ?? '';

// Validasi input
if (empty($id_fakultas)) {
    echo json_encode([]);
    exit;
}

// Escape input untuk keamanan
$id_fakultas = mysqli_real_escape_string($conn, $id_fakultas);

// Query untuk mengambil jurusan berdasarkan fakultas
$query = "SELECT id_jurusan, nama_jurusan FROM jurusan WHERE id_fakultas = '$id_fakultas' ORDER BY nama_jurusan ASC";
$result = mysqli_query($conn, $query);

$jurusan_data = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jurusan_data[] = [
            'id_jurusan' => $row['id_jurusan'],
            'nama_jurusan' => $row['nama_jurusan']
        ];
    }
}

// Return data dalam format JSON
echo json_encode($jurusan_data);
?>