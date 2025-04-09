<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Gunakan variabel $koneksi secara konsisten di semua file
$koneksi = new mysqli("localhost", "root", "", "karyawan_db");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$koneksi->set_charset("utf8mb4");
?>
