<?php
session_start();
include "./koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($name) || empty($email) || empty($password)) {
        $error = "Semua bidang harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Alamat email tidak valid.";
    } else {
        // Periksa apakah email sudah terdaftar
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email sudah terdaftar. Silakan gunakan email lain.";
        } else {
            // Hash password sebelum menyimpan
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Simpan data ke database
            $query = "INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $role = 'operator';
            $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

            if ($stmt->execute()) {
                // Pendaftaran berhasil, redirect ke halaman login
                $_SESSION['signup_success'] = "Pendaftaran berhasil. Silakan login.";
                header("Location: $base_url/index.php");
                exit;
            } else {
                $error = "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
            }
        }
    }
}
