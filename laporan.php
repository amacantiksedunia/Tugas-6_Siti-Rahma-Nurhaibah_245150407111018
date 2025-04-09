<?php
session_start();
require_once 'config.php';
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <title>Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (sama seperti sebelumnya) -->
        
        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Laporan</h2>
            
            <!-- Filter -->
            <div class="card mb-4">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-md-3">
                                <label>Periode Awal</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Periode Akhir</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-3 align-self-end">
                                <button class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Tabel Laporan -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Total Gaji</th>
                                <th>Jumlah Karyawan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Januari 2023</td>
                                <td>Rp 25.000.000</td>
                                <td>5</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-download"></i> Export
                                    </a>
                                </td>
                            </tr>
                            <!-- Data lainnya -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
