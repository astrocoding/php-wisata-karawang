<?php
include("../php/koneksi.php");

$id = $_GET['id'];

$query = "SELECT * FROM tempat_wisata WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ID">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Paket Wisata | Zaenal Alfian</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .image-section img {
            border-radius: 15px;
            width: 90%;
            height: 250px;
        }
        .form-section {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
        }
        .btn-back {
            background-color: #F99090;
            border-radius: 20px;
            width: 90%;
            font-weight: 600;
        }
        .btn-back:hover {
            background-color: #F76C6C;
        }
        .btn-custom {
            width: 7em;
            border-radius: 20px;
            font-weight: 500;
        }
        .price {
            color: #75A3C8;
        }
        i.location {
            color: #F99090;
        }
    </style>
</head>
<body>
    <div class="container mb-5">
        <div class="row">
            <!-- Gambar dan detail -->
            <div class="col-md-4">
                <div class="image-section">
                    <img src="<?= $data['gambar']; ?>" class="img-fluid" alt="Pantai Tanjung Pakis">
                </div>
                <div class="mt-4">
                    <h4><?= $data['nama_lokasi']; ?></h4>
                    <p><strong>Harga Tiket</strong><br><span id="hargaTiket" class="price fw-bold">Rp. <?= number_format($data['harga'], 0, ',', '.'); ?>/orang</span></p>
                    <p><strong>Lokasi</strong><br><i class="bi bi-geo-alt-fill location"></i> <?= $data['lokasi']; ?></p>
                    <a href="<?= $base_url; ?>/index.php" class="btn btn-back text-light mt-2 mb-4">Kembali</a>
                </div>
            </div>

            <!-- Form input -->
            <div class="col-md-8 shadow">
                <div class="form-section">
                    <h2 class="text-center fw-bold">Reservasi Paket Wisata</h2>
                    <form method="POST" action="<?= $base_url; ?>/php/proses_pesanan.php">
                        <input type="hidden" id="tiketPrice" name="tiket" value="<?= $data['harga']; ?>">
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Pemesan</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-bold">Nomor Telp/HP</label>
                            <input type="tel" class="form-control" id="phone" name="telp" placeholder="Nomor Telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="participants" class="form-label fw-bold">Jumlah Peserta</label>
                            <input type="number" class="form-control" id="participants" name="partisipan" value="1" min="1" max="100" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label fw-bold">Waktu Pelaksanaan</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="durasi" class="form-label fw-bold">Durasi Wisata</label>
                            <input type="number" class="form-control" id="durasi" name="durasi" value="1" min="1" max="100" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pelayanan Paket Wisata</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="penginapan" name="penginapan" value="Penginapan" checked>
                                <label class="form-check-label" for="penginapan" id="penginapanPrice"><strong>Penginapan</strong> (Rp. 1.000.000)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="transportasi" name="transportasi" value="Transportasi">
                                <label class="form-check-label" for="transportasi" id="transportasiPrice"><strong>Transportasi</strong> (Rp. 1.200.000)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="makanan" name="makanan" value="Makanan">
                                <label class="form-check-label" for="makanan" id="makananPrice"><strong>Makanan</strong> (Rp. 500.000)</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="subtotal" class="form-label fw-bold">Harga Paket</label>
                            <input type="text" class="form-control" id="subtotal" name="subtotal" value="" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label fw-bold">Jumlah Tagihan</label>
                            <input type="text" class="form-control" id="total" name="total" value="" readonly>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-danger btn-custom">Batal</button>
                            <div class="d-flex">
                                <button type="button" id="hitung" class="btn btn-secondary btn-custom me-2">Hitung</button>
                                <button type="submit" id="simpan" class="btn btn-primary btn-custom">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $base_url; ?>/script/script.js"></script>
</body>
</html>
