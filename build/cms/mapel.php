<?php
include '../../db-connection/koneksi.php';

$fakultas = mysqli_query($conn, "SELECT * FROM fakultas ORDER BY nama_fakultas ASC");
$jurusan = mysqli_query($conn, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");

$filter_fakultas = $_GET['fakultas'] ?? '';
$filter_jurusan = $_GET['jurusan'] ?? '';
$keyword = $_GET['keyword'] ?? '';

$where = [];

if ($filter_jurusan) {
  $where[] = "mata_pelajaran.id_jurusan = '$filter_jurusan'";
} elseif ($filter_fakultas) {
  $where[] = "jurusan.id_fakultas = '$filter_fakultas'";
}

if (!empty($keyword)) {
  $where[] = "mata_pelajaran.nama_mapel LIKE '%$keyword%'";
}

$where_sql = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

$mapel = mysqli_query($conn, "
  SELECT mata_pelajaran.*, jurusan.nama_jurusan 
  FROM mata_pelajaran 
  JOIN jurusan ON mata_pelajaran.id_jurusan = jurusan.id_jurusan 
  $where_sql 
  ORDER BY nama_mapel ASC
");

if (isset($_POST['tambah'])) {
  $id_jurusan = $_POST['id_jurusan'];
  $nama_mapel = $_POST['nama_mapel'];
  mysqli_query($conn, "INSERT INTO mata_pelajaran (id_jurusan, nama_mapel) VALUES ('$id_jurusan', '$nama_mapel')");
  header("Location: mapel.php");
  exit;
}

if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM mata_pelajaran WHERE id_mapel = $id");
  header("Location: mapel.php");
  exit;
}

if (isset($_POST['edit'])) {
  $id = $_POST['id_mapel'];
  $id_jurusan = $_POST['id_jurusan'];
  $nama = $_POST['nama_mapel'];
  mysqli_query($conn, "UPDATE mata_pelajaran SET nama_mapel='$nama', id_jurusan='$id_jurusan' WHERE id_mapel = $id");
  header("Location: mapel.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Mata Pelajaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-3">
      <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-9 p-4">
      <h3>Data Mata Pelajaran</h3>

      <form method="GET" class="row g-2 mb-4">
        <div class="col-md-3">
          <select name="fakultas" class="form-select" onchange="this.form.submit()">
            <option value="">Semua Fakultas</option>
            <?php while ($f = mysqli_fetch_assoc($fakultas)): ?>
              <option value="<?= $f['id_fakultas'] ?>" <?= ($f['id_fakultas'] == $filter_fakultas) ? 'selected' : '' ?>>
                <?= $f['nama_fakultas'] ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-3">
          <select name="jurusan" class="form-select" onchange="this.form.submit()">
            <option value="">Semua Jurusan</option>
            <?php mysqli_data_seek($jurusan, 0); while ($j = mysqli_fetch_assoc($jurusan)): ?>
              <?php if (!$filter_fakultas || $j['id_fakultas'] == $filter_fakultas): ?>
              <option value="<?= $j['id_jurusan'] ?>" <?= ($j['id_jurusan'] == $filter_jurusan) ? 'selected' : '' ?>>
                <?= $j['nama_jurusan'] ?>
              </option>
              <?php endif; ?>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-4">
          <input type="text" name="keyword" class="form-control" placeholder="Cari mata pelajaran..." value="<?= htmlspecialchars($keyword) ?>">
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary w-100">Cari</button>
        </div>
      </form>

      <form method="POST" class="row g-2 mb-4">
        <div class="col-md-5">
          <input type="text" name="nama_mapel" class="form-control" placeholder="Nama Mata Pelajaran" required>
        </div>
        <div class="col-md-5">
          <select name="id_jurusan" class="form-select" required>
            <option disabled selected>Pilih Jurusan</option>
            <?php mysqli_data_seek($jurusan, 0); while($j = mysqli_fetch_assoc($jurusan)): ?>
              <option value="<?= $j['id_jurusan'] ?>"><?= $j['nama_jurusan'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" name="tambah" class="btn btn-success w-100">Tambah</button>
        </div>
      </form>

      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Mapel</th>
            <th>Jurusan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; while($m = mysqli_fetch_assoc($mapel)): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($m['nama_mapel']) ?></td>
            <td><?= htmlspecialchars($m['nama_jurusan']) ?></td>
            <td>
              <form method="POST" class="d-inline-flex flex-wrap">
                <input type="hidden" name="id_mapel" value="<?= $m['id_mapel'] ?>">
                <input type="text" name="nama_mapel" value="<?= htmlspecialchars($m['nama_mapel']) ?>" class="form-control me-2 mb-1" required>
                <select name="id_jurusan" class="form-select me-2 mb-1" required>
                  <?php mysqli_data_seek($jurusan, 0); while($j = mysqli_fetch_assoc($jurusan)): ?>
                    <option value="<?= $j['id_jurusan'] ?>" <?= ($j['id_jurusan'] == $m['id_jurusan']) ? 'selected' : '' ?>>
                      <?= $j['nama_jurusan'] ?>
                    </option>
                  <?php endwhile; ?>
                </select>
                <button type="submit" name="edit" class="btn btn-warning btn-sm me-1 mb-1">Edit</button>
                <a href="?hapus=<?= $m['id_mapel'] ?>" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Hapus mata pelajaran ini?')">Hapus</a>
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
