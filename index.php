<?php
session_start();

if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] !== true) {
    header("Location: login.php");
    exit;
}


// Gunakan variabel $koneksi secara konsisten di semua file
$koneksi = new mysqli("localhost", "root", "", "karyawan_db");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Insert
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $gaji = $_POST['gaji'];
    
    $stmt = $koneksi->prepare("INSERT INTO karyawan (nama, jabatan, gaji) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nama, $jabatan, $gaji);
    $stmt->execute();
    header("Location: index.php");
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $gaji = $_POST['gaji'];
    $koneksi->query("UPDATE karyawan SET nama='$nama', jabatan='$jabatan', gaji='$gaji' WHERE id=$id");
    header("Location: index.php");
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $koneksi->query("DELETE FROM karyawan WHERE id=$id");
    header("Location: index.php");
}

// Ambil data karyawan untuk edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $koneksi->query("SELECT * FROM karyawan WHERE id=$id");
    $editData = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <title>Dashboard Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-3">
            <h4 class="mb-4">Admin Panel</h4>
            <div class="nav flex-column">
                <a href="dashboard.php" class="nav-link active">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <a href="index.php" class="nav-link">
                    <i class="bi bi-people-fill me-2"></i> Karyawan
                </a>
                <a href="laporan.php" class="nav-link">
                    <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4">Manajemen Karyawan Beauty Group</h2>

            <!-- Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" required value="<?= $editData['nama'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label>Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" required value="<?= $editData['jabatan'] ?? '' ?>">
                        </div>
                        <div class="mb-3">
                            <label>Gaji</label>
                            <input type="number" class="form-control" name="gaji" required value="<?= $editData['gaji'] ?? '' ?>">
                        </div>
                        <button type="submit" name="<?= $editData ? 'update' : 'tambah' ?>" class="btn btn-success">
                            <?= $editData ? 'Update Data' : 'Tambah Karyawan' ?>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tabel -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Gaji</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $data = $koneksi->query("SELECT * FROM karyawan ORDER BY id DESC");
                        while ($row = $data->fetch_assoc()) {
                            echo "<tr>
                            <td>" . $row['nama'] . "</td>
                            <td>" . $row['jabatan'] . "</td>
                            <td>Rp " . number_format($row['gaji'], 0, ',', '.') . "</td>
                            <td>
                                <a href='?edit=" . $row['id'] . "' class='btn btn-sm btn-warning'>Edit</a>
                                <a href='?delete=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin hapus?')\">Hapus</a>
                            </td>
                        </tr>";

                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>
