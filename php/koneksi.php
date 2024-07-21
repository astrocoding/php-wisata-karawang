<?php
$host = "localhost";
$username = "phpmyadmin";
$password = "admin123";
$database = "db_wisata";

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$basePath = '/wisata-karawang';

$base_url = $protocol . $host . $basePath;

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
