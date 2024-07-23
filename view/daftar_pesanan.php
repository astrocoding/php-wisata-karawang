<?php
session_start();
include("../php/koneksi.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'operator') {
    header("Location: $base_url/index.php");
    exit;
}

$sql = "SELECT * FROM pemesanan ORDER BY tanggal DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .container-box {
            width: 90%;
            margin-top: 50px;
            margin-bottom: 7em;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .logout {
            color: #F99090 !important;
        }
    </style>
</head>
<body>
    <nav class="container navbar navbar-expand-lg navbar-light pt-4">
        <a class="navbar-brand brand-title" href="<?= $base_url; ?>/index.php">Wisata Karawang</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav-menu" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item menu-items">
                    <a class="nav-link fw-bold" href="<?= $base_url; ?>/view/daftar_pesanan.php">Home</a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="#destinasi">Wisata</a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="#">Layanan</a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= $base_url; ?>/view/form_wisata.php">Lokasi</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item menu-items">
                    <a class="nav-link fw-bold logout" href="<?= $base_url; ?>/php/logout.php">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item menu-items">
                    <a class="nav-link fw-bold" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white signup" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">Sign up</a>
                </li>
            <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container-fluid container-box">
        <h2 class="text-center">Daftar Pesanan</h2>
        <?php
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == 'sukses') {
                    echo "<div class='container alert alert-success alert-dismissible fade show text-center' role='alert'>
                            Data berhasil dihapus.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                } elseif ($_GET['pesan'] == 'gagal') {
                    echo "<div class='container alert alert-danger alert-dismissible fade show text-center' role='alert'>
                            Gagal menghapus data.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }
            }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Jumlah Peserta</th>
                        <th>Tanggal</th>
                        <th>Durasi</th>
                        <th>Penginapan</th>
                        <th>Transportasi</th>
                        <th>Makanan</th>
                        <th>Harga Paket</th>
                        <th>Total Tagihan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?= $row['nama'] ?></td>
                        <td><?= htmlspecialchars($row['telp']); ?></td>
                        <td><?= htmlspecialchars($row['partisipan']); ?> orang</td>
                        <td><?= htmlspecialchars($row['tanggal']); ?></td>
                        <td><?= htmlspecialchars($row['durasi']); ?> hari</td>
                        <td><?= ($row['penginapan'] ? 'Ya' : 'Tidak'); ?></td>
                        <td><?= ($row['transportasi'] ? 'Ya' : 'Tidak'); ?></td>
                        <td><?= ($row['makanan'] ? 'Ya' : 'Tidak'); ?></td>
                        <td>Rp. <?= number_format($row['subtotal'], 0, ',', '.'); ?></td>
                        <td>Rp. <?= number_format($row['total'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#updateModal" onclick="loadDataToModal(<?= htmlspecialchars(json_encode($row)); ?>)">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" onclick="confirmDeletion('<?= $row['id']; ?>'); return false;" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>Tidak ada data pesanan</td></tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLongTitle">Update Data Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?= $base_url; ?>/php/update_pesanan.php">
                            <input type="hidden" id="id" name="id">
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
                                    <input class="form-check-input" type="checkbox" id="penginapan" name="penginapan" value="Penginapan">
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
                                <input type="hidden" class="form-control" id="tiketPrice" name="tiket" value="">
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
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $base_url; ?>/script/script.js"></script>
    <script>
        function confirmDeletion(id) {
                if (confirm('Apakah kamu yakin ingin menghapus data pesanan ini?')) {
                window.location.href = "<?= $base_url; ?>/php/hapus_pesanan.php?id=" + id;
            }
        }
    </script>

<?php
include "footer.php";
$conn->close();
?>
