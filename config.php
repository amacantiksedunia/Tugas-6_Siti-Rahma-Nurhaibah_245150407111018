<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1); 

// koneksi ke sql
$koneksi = new mysqli("localhost", "root", "", "karyawan_db");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$koneksi->set_charset("utf8mb4");
?>
