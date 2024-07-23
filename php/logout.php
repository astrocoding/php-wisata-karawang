<?php
  session_start();
  include "./koneksi.php";
  session_unset();
  session_destroy();
  header("Location: $base_url/index.php");
  exit;
