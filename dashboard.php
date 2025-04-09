<?php
session_start();
include "config.php";

if (!isset($_SESSION['username'])) {
    // Belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Redirect ke login hanya jika belum login
if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar (sama seperti di index.php) -->
        
        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Dashboard</h2>
            
            <!-- Cards Statistik -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card stat-card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Karyawan</h5>
                            <h2 class="mb-0">
                                <?php 
                                $result = $koneksi->query("SELECT COUNT(*) FROM karyawan");
                                echo $result->fetch_row()[0]; 
                                ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <!-- untuk card statistik lainnya -->
            </div>
            
            <!-- Grafik -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Grafik Gaji Karyawan</h5>
                    <div id="chart-container" style="height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk grafik -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Implementasi grafik dengan Chart.js
    const ctx = document.createElement('canvas');
    document.getElementById('chart-container').appendChild(ctx);
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Total Gaji',
                data: [12000000, 19000000, 3000000, 5000000, 2000000, 3000000],
                backgroundColor: 'rgba(54, 162, 235, 0.5)'
            }]
        }
    });
</script>
</body>
</html>
