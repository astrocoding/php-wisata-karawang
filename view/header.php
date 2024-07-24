<?php
    include("./php/koneksi.php");
?>
<!DOCTYPE html>
<html lang="ID">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Karawang | Zaenal Alfian</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="<?= $base_url; ?>/css/styles.css">
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
                    <a class="nav-link fw-bold" href="<?= $base_url; ?>/index.php">Home</a>
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
            </ul>
            <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item menu-items">
                    <a class="nav-link fw-bold" href="<?= $base_url; ?>/logout.php">Logout</a>
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

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $base_url; ?>/php/login.php" method="POST">
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="loginEmail" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="loginPassword" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-center">Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Sign up</a></p>
            </div>
            </div>
        </div>
        </div>

        <!-- Modal Sign-Up -->
        <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $base_url; ?>/php/signup.php" method="POST">
                <div class="mb-3">
                    <label for="signupName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="signupName" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="signupEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="signupEmail" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="signupPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="signupPassword" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                </form>
            </div>
            <div class="modal-footer">
                <p class="text-center">Sudah punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</a></p>
            </div>
            </div>
        </div>
    </div>
