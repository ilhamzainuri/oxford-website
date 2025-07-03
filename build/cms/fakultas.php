<?php
include '../../db-connection/koneksi.php';

// Tambah Fakultas
if (isset($_POST['tambah'])) {
  $nama = $_POST['nama_fakultas'];
  mysqli_query($conn, "INSERT INTO fakultas (nama_fakultas) VALUES ('$nama')");
  header("Location: fakultas.php");
  exit;
}

// Hapus Fakultas
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM fakultas WHERE id_fakultas = $id");
  header("Location: fakultas.php");
  exit;
}

// Edit Fakultas
if (isset($_POST['edit'])) {
  $id = $_POST['id_fakultas'];
  $nama = $_POST['nama_fakultas'];
  mysqli_query($conn, "UPDATE fakultas SET nama_fakultas = '$nama' WHERE id_fakultas = $id");
  header("Location: fakultas.php");
  exit;
}

$data = mysqli_query($conn, "SELECT * FROM fakultas ORDER BY nama_fakultas ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Fakultas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-3">
      <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-9 p-4">
      <h3>Data Fakultas</h3>

      <!-- Form Tambah -->
      <form method="POST" class="d-flex my-3">
        <input type="text" name="nama_fakultas" class="form-control me-2" placeholder="Nama Fakultas" required>
        <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
      </form>

      <!-- Tabel -->
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Fakultas</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; while($row = mysqli_fetch_assoc($data)): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_fakultas'] ?></td>
            <td>
              <!-- Form Edit -->
              <form method="POST" class="d-inline-flex">
                <input type="hidden" name="id_fakultas" value="<?= $row['id_fakultas'] ?>">
                <input type="text" name="nama_fakultas" value="<?= $row['nama_fakultas'] ?>" class="form-control me-2" required>
                <button type="submit" name="edit" class="btn btn-warning btn-sm me-1">Edit</button>
                <a href="?hapus=<?= $row['id_fakultas'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
              </form>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
