<?php
    session_start();
    include("../php/koneksi.php");
    
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'operator') {
        header("Location: $base_url/index.php");
        exit;
    }    
?>
<!DOCTYPE html>
<html lang="ID">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Tempat Wisata</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .form-section {
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <div class="mb-3">
                <a href="<?php echo $base_url; ?>/view/daftar_pesanan.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
            <h2 class="text-center">Input Data Tempat Wisata</h2>
            <form method="POST" action="<?= $base_url; ?>/php/proses_wisata.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_lokasi" class="form-label fw-bold">Nama Lokasi</label>
                    <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" placeholder="Nama Lokasi" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label fw-bold">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label fw-bold">Harga Tiket</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Tiket" required>
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label fw-bold">Lokasi</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi" required>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label fw-bold">Lokasi</label>
                    <input type="text" class="form-control" id="gambar" name="gambar" placeholder="Url gambar" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="reset" class="btn btn-danger">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
