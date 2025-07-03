<?php
include '../../db-connection/koneksi.php';

// Tambah Jurusan
if (isset($_POST['tambah'])) {
  $id_fakultas = $_POST['id_fakultas'];
  $nama_jurusan = $_POST['nama_jurusan'];
  mysqli_query($conn, "INSERT INTO jurusan (id_fakultas, nama_jurusan) VALUES ('$id_fakultas', '$nama_jurusan')");
  header("Location: jurusan.php");
  exit;
}

// Hapus Jurusan
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM jurusan WHERE id_jurusan = $id");
  header("Location: jurusan.php");
  exit;
}

// Edit Jurusan
if (isset($_POST['edit'])) {
  $id = $_POST['id_jurusan'];
  $id_fakultas = $_POST['id_fakultas'];
  $nama = $_POST['nama_jurusan'];
  mysqli_query($conn, "UPDATE jurusan SET nama_jurusan='$nama', id_fakultas='$id_fakultas' WHERE id_jurusan = $id");
  header("Location: jurusan.php");
  exit;
}

// Ambil data
$jurusan = mysqli_query($conn, "SELECT jurusan.*, fakultas.nama_fakultas FROM jurusan JOIN fakultas ON jurusan.id_fakultas = fakultas.id_fakultas ORDER BY jurusan.nama_jurusan ASC");
$fakultas = mysqli_query($conn, "SELECT * FROM fakultas ORDER BY nama_fakultas ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Jurusan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-3">
      <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-9 p-4">
      <h3>Data Jurusan</h3>

      <!-- Form Tambah -->
      <form method="POST" class="row g-2 my-3">
        <div class="col-md-5">
          <input type="text" name="nama_jurusan" class="form-control" placeholder="Nama Jurusan" required>
        </div>
        <div class="col-md-5">
          <select name="id_fakultas" class="form-select" required>
            <option disabled selected>Pilih Fakultas</option>
            <?php while($f = mysqli_fetch_assoc($fakultas)): ?>
              <option value="<?= $f['id_fakultas'] ?>"><?= $f['nama_fakultas'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" name="tambah" class="btn btn-success w-100">Tambah</button>
        </div>
      </form>

      <!-- Tabel Data Jurusan -->
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Jurusan</th>
            <th>Fakultas</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; mysqli_data_seek($fakultas, 0); while($j = mysqli_fetch_assoc($jurusan)): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $j['nama_jurusan'] ?></td>
            <td><?= $j['nama_fakultas'] ?></td>
            <td>
              <!-- Form Edit -->
              <form method="POST" class="d-inline-flex flex-wrap">
                <input type="hidden" name="id_jurusan" value="<?= $j['id_jurusan'] ?>">
                <input type="text" name="nama_jurusan" value="<?= $j['nama_jurusan'] ?>" class="form-control me-2 mb-1" required>
                <select name="id_fakultas" class="form-select me-2 mb-1" required>
                  <?php mysqli_data_seek($fakultas, 0); while($f = mysqli_fetch_assoc($fakultas)): ?>
                    <option value="<?= $f['id_fakultas'] ?>" <?= ($f['id_fakultas'] == $j['id_fakultas']) ? 'selected' : '' ?>>
                      <?= $f['nama_fakultas'] ?>
                    </option>
                  <?php endwhile; ?>
                </select>
                <button type="submit" name="edit" class="btn btn-warning btn-sm me-1 mb-1">Edit</button>
                <a href="?hapus=<?= $j['id_jurusan'] ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Hapus jurusan ini?')">Hapus</a>
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
