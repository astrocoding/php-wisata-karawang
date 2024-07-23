<?php
include "./koneksi.php";

$id = mt_rand(100000, 999999);
$nama = $_POST['nama'];
$telp = $_POST['telp'];
$partisipan = $_POST['partisipan'];
$tanggal = $_POST['tanggal'];
$durasi = $_POST['durasi'];
$penginapan = isset($_POST['penginapan']) ? 1 : 0;
$transportasi = isset($_POST['transportasi']) ? 1 : 0;
$makanan = isset($_POST['makanan']) ? 1 : 0;
$tiket = $_POST['tiket'];
$total = str_replace('.', '', str_replace('Rp. ', '', $_POST['total']));
$subtotal = str_replace('.', '', str_replace('Rp. ', '', $_POST['subtotal']));
$createdAt = date('Y-m-d H:i:s');


$sql = "INSERT INTO pemesanan (id, nama, telp, partisipan, tanggal, durasi, penginapan, transportasi, makanan, tiket, subtotal, total, createdAt)
VALUES ('$id', '$nama', '$telp', $partisipan, '$tanggal', $durasi, $penginapan, $transportasi, $makanan, $tiket, $subtotal, $total, '$createdAt')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>Reservasi berhasil disimpan!</h2>";
    header("Location: $base_url/view/daftar_pesanan.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);
