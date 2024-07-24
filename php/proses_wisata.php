<?php
include "./koneksi.php";

$id = mt_rand(100000, 999999);
$nama_lokasi = $_POST['nama_lokasi'];
$kategori = $_POST['kategori'];
$harga = $_POST['harga'];
$lokasi = $_POST['lokasi'];
$gambar = $_POST['gambar'];
$createdAt = date('Y-m-d H:i:s');

$sql = "INSERT INTO tempat_wisata (id, nama_lokasi, kategori, harga, lokasi, gambar, createdAt)
VALUES ($id, '$nama_lokasi', '$kategori', $harga, '$lokasi', '$gambar', '$createdAt')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Data tempat wisata berhasil disimpan!</h2>";
    header("Location: $base_url/index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);