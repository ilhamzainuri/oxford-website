<?php
include '../../db-connection/koneksi.php';

$fakultas = mysqli_query($conn, "SELECT * FROM fakultas ORDER BY nama_fakultas ASC");
$id_fakultas = $_GET['id_fakultas'] ?? '';
$id_jurusan = $_GET['id_jurusan'] ?? '';
$keyword = $_GET['keyword'] ?? '';
$where = [];

if (!empty($id_fakultas)) {
  $where[] = "s.faculty_id = '" . mysqli_real_escape_string($conn, $id_fakultas) . "'";
}
if (!empty($id_jurusan)) {
  $where[] = "s.major_id = '" . mysqli_real_escape_string($conn, $id_jurusan) . "'";
}
if (!empty($keyword)) {
  $where[] = "s.full_name LIKE '%" . mysqli_real_escape_string($conn, $keyword) . "%'";
}
$filter_sql = count($where) > 0 ? 'WHERE ' . implode(' AND ', $where) : '';

$minat = mysqli_query($conn, "
  SELECT m.id, s.full_name, mp.nama_mapel, j.nama_jurusan, f.nama_fakultas
  FROM minat_mahasiswa m
  JOIN student s ON m.id_student = s.id
  JOIN mata_pelajaran mp ON m.id_mapel = mp.id_mapel
  JOIN jurusan j ON s.major_id = j.id_jurusan
  JOIN fakultas f ON s.faculty_id = f.id_fakultas
  $filter_sql
  ORDER BY s.full_name ASC
");

if (!empty($id_fakultas)) {
  $jurusan_query = "SELECT * FROM jurusan WHERE id_fakultas = '" . mysqli_real_escape_string($conn, $id_fakultas) . "' ORDER BY nama_jurusan ASC";
  $jurusan = mysqli_query($conn, $jurusan_query);
  if (!$jurusan) {
    $jurusan = mysqli_query($conn, "
      SELECT DISTINCT j.* 
      FROM jurusan j 
      JOIN student s ON j.id_jurusan = s.major_id 
      WHERE s.faculty_id = '" . mysqli_real_escape_string($conn, $id_fakultas) . "' 
      ORDER BY j.nama_jurusan ASC
    ");
  }
} else {
  $jurusan = mysqli_query($conn, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");
}

$fakultas_array = [];
$jurusan_array = [];

mysqli_data_seek($fakultas, 0);
while ($f = mysqli_fetch_assoc($fakultas)) {
  $fakultas_array[] = $f;
}
if ($jurusan) {
  mysqli_data_seek($jurusan, 0);
  while ($j = mysqli_fetch_assoc($jurusan)) {
    $jurusan_array[] = $j;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Minat Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-3">
      <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-9 p-4">
      <h3>Minat Mahasiswa</h3>

      <form method="GET" class="row g-2 mb-4">
        <div class="col-md-3">
          <select name="id_fakultas" class="form-select" onchange="this.form.submit()">
            <option value="">-- Semua Fakultas --</option>
            <?php foreach ($fakultas_array as $f): ?>
              <option value="<?= $f['id_fakultas'] ?>" <?= ($id_fakultas == $f['id_fakultas']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($f['nama_fakultas']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-3">
          <select name="id_jurusan" class="form-select" onchange="this.form.submit()">
            <option value="">-- Semua Jurusan --</option>
            <?php foreach ($jurusan_array as $j): ?>
              <option value="<?= $j['id_jurusan'] ?>" <?= ($id_jurusan == $j['id_jurusan']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($j['nama_jurusan']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4">
          <input type="text" name="keyword" class="form-control" placeholder="Cari Nama Mahasiswa..." value="<?= htmlspecialchars($keyword) ?>">
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary w-100">Cari</button>
        </div>
      </form>

      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="table-dark">
            <tr>
              <th>No</th>
              <th>Nama Mahasiswa</th>
              <th>Mata Pelajaran</th>
              <th>Jurusan</th>
              <th>Fakultas</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if (mysqli_num_rows($minat) > 0) {
              $no = 1; 
              while($m = mysqli_fetch_assoc($minat)): 
            ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($m['full_name']) ?></td>
                <td><?= htmlspecialchars($m['nama_mapel']) ?></td>
                <td><?= htmlspecialchars($m['nama_jurusan']) ?></td>
                <td><?= htmlspecialchars($m['nama_fakultas']) ?></td>
              </tr>
            <?php 
              endwhile;
            } else {
              echo "<tr><td colspan='5' class='text-center'>Tidak ada data minat mahasiswa</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <div class="mt-3">
        <p class="text-muted">
          Total: <?= mysqli_num_rows($minat) ?> data minat mahasiswa
          <?php if (!empty($id_fakultas) || !empty($id_jurusan) || !empty($keyword)): ?>
            (dengan filter/pencarian)
          <?php endif; ?>
        </p>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
