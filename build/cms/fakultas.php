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

// Keyword pencarian
$keyword = $_GET['keyword'] ?? '';
$keyword_sql = mysqli_real_escape_string($conn, $keyword);

// Query data dengan atau tanpa search
$query = "SELECT * FROM fakultas";
if (!empty($keyword)) {
  $query .= " WHERE nama_fakultas LIKE '%$keyword_sql%'";
}
$query .= " ORDER BY nama_fakultas ASC";

$data = mysqli_query($conn, $query);
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

      <!-- Form Pencarian -->
      <form method="GET" class="d-flex mb-3">
        <input type="text" name="keyword" class="form-control me-2" placeholder="Cari nama fakultas..." value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit" class="btn btn-secondary">Cari</button>
      </form>

      <!-- Form Tambah -->
      <form method="POST" class="d-flex mb-4">
        <input type="text" name="nama_fakultas" class="form-control me-2" placeholder="Nama Fakultas" required>
        <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
      </form>

      <!-- Tabel Data Fakultas -->
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Fakultas</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($data) > 0): $no = 1; ?>
            <?php while($row = mysqli_fetch_assoc($data)): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['nama_fakultas']) ?></td>
              <td>
                <!-- Form Edit -->
                <form method="POST" class="d-inline-flex">
                  <input type="hidden" name="id_fakultas" value="<?= $row['id_fakultas'] ?>">
                  <input type="text" name="nama_fakultas" value="<?= htmlspecialchars($row['nama_fakultas']) ?>" class="form-control me-2" required>
                  <button type="submit" name="edit" class="btn btn-warning btn-sm me-1">Edit</button>
                  <a href="?hapus=<?= $row['id_fakultas'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </form>
              </td>
            </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="3" class="text-center text-muted">Tidak ada data ditemukan.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
