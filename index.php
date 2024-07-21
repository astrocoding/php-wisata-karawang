<?php
    include("./view/header.php");
    include("./php/koneksi.php");

    $categories = ["Populer", "Pantai", "Alam", "Monumen", "Wahana", "Lainnya"];
?>
    <div class="container hero content-box">
        <div class="row">
            <div class="col-md-6">
                <div class="location-box">
                    <i class="bi bi-geo-alt-fill location"></i> Karawang
                </div>                
                <h1 class="sub-title mb-5">Rasakan <strong>Keseruan Wisata Karawang!</strong></h1>
                <p class="desc">Temukan pesona tersembunyi Karawang dengan destinasi wisata alam yang memukau, sejarah yang kaya, dan kuliner lezat. Jelajahi keindahan pantai, air terjun, dan situs budaya yang menakjubkan.</p>
            </div>
            <div class="col-md-6">
                <img class="img" src="<?= $base_url; ?>/img/krw.png" width="450" alt="Karawang Image">
            </div>
        </div>
    </div>

    <div id="destinasi" class="container-fluid search-bar text-center">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="ask">Siap untuk berwisata?</h2>
            <div class="input-group search-box">
                <input type="text" class="form-control" placeholder="Temukan Destinasi . . .">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container destinations">
        <h2 class="text-center mt-5 mb-5 section-title">Destinasi Wisata</h2>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <?php foreach ($categories as $index => $category) : ?>
                <li class="nav-item">
                    <a class="nav-link fw-bold <?php echo $index === 0 ? 'active' : ''; ?>" id="<?php echo strtolower($category); ?>-tab" data-toggle="tab" href="#<?php echo strtolower($category); ?>" role="tab" aria-controls="<?php echo strtolower($category); ?>" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"><?php echo $category; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="tab-content mt-4" id="myTabContent">
            <?php foreach ($categories as $index => $category) : ?>
                <div class="tab-pane fade <?php echo $index === 0 ? 'show active' : ''; ?>" id="<?php echo strtolower($category); ?>" role="tabpanel" aria-labelledby="<?php echo strtolower($category); ?>-tab">
                    <div class="row content-box">
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM tempat_wisata WHERE kategori = ? ORDER BY nama_lokasi ASC");
                            $stmt->bind_param("s", $category);
                            $stmt->execute();
                            $filtered_result = $stmt->get_result();

                            if ($filtered_result->num_rows > 0) {
                                while ($row = $filtered_result->fetch_assoc()) {
                        ?>
                                <div class="col-md-4 mb-5">
                                    <div class="card no-border">
                                        <img src="<?=$row['gambar']; ?>" class="card-img-top" alt="<?= $row['nama_lokasi']; ?>">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <p class="card-text"><?=$row['kategori']; ?></p>
                                                <p class="card-text price"><strong>Rp. <?= number_format($row['harga'], 0, ',', '.'); ?>/orang</strong></p>
                                            </div>
                                            <h5 class="card-title"><?= $row['nama_lokasi']; ?></h5>
                                            <div class="d-flex justify-content-between">
                                                <p class="card-text"><i class="bi bi-geo-alt-fill location"></i><?= $row['lokasi']; ?></p>
                                                <a href="<?= $base_url; ?>/view/form_pesanan.php?id=<?= $row['id']; ?>" class="btn btn-primary pesan">Pesan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                                }
                            } else {
                                echo '<h2 class="text-center">DESTINASI TIDAK DITEMUKAN!</h2>';
                            }
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container video-section">
        <div class="row">
            <div class="col-md-6">
                <iframe src="https://www.youtube.com/embed/9_GegVlaOIs" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center">
                <h2 class="text-center mt-5 mb-5 fw-bold">Mari Berwisata Di Karawang</h2>
                <a href="#" class="btn btn-light">Temukan</a>
            </div>
        </div>
    </div>

<?php
    include("./view/footer.php");
?>
