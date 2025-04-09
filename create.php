<?php 
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST["nama"];
  $jabatan = $_POST["jabatan"];
  $gaji = $_POST["gaji"];
  $conn->query("INSERT INTO karyawan (nama, jabatan, gaji) VALUES ('$nama', '$jabatan', '$gaji')");
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <title>Tambah Karyawan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>Tambah Data Karyawan</h2>
    
    <!-- untuk menambah data karyawan -->
    <form method="post">
      <div class="mb-3">
        <label>Nama:</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Jabatan:</label>
        <input type="text" name="jabatan" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Gaji:</label>
        <input type="number" name="gaji" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</body>
</html>
