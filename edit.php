<?php include 'config.php'; ?>
<?php
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM karyawan WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST["nama"];
  $jabatan = $_POST["jabatan"];
  $gaji = $_POST["gaji"];
  $conn->query("UPDATE karyawan SET nama='$nama', jabatan='$jabatan', gaji='$gaji' WHERE id=$id");
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <title>Edit Karyawan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2>Edit Data Karyawan</h2>
    <form method="post">
      <div class="mb-3">
        <label>Nama:</label>
        <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Jabatan:</label>
        <input type="text" name="jabatan" class="form-control" value="<?= $data['jabatan'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Gaji:</label>
        <input type="number" name="gaji" class="form-control" value="<?= $data['gaji'] ?>" required>
      </div>
      <button type="submit" class="btn btn-warning">Update</button>
      <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</body>
</html>
