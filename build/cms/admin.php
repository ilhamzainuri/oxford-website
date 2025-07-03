<?php
include '../../db-connection/koneksi.php';

// Verifikasi status mahasiswa jika ada permintaan dari form
if (isset($_POST['verifikasi'])) {
  $id = $_POST['id'];
  $status = $_POST['status'];
  mysqli_query($conn, "UPDATE student SET status_penerimaan = '$status' WHERE id = $id");
  header("Location: admin.php");
  exit;
}

// Cek keyword pencarian
$keyword = $_GET['keyword'] ?? '';

$mahasiswa = mysqli_query($conn, "
  SELECT student.*, jurusan.nama_jurusan, fakultas.nama_fakultas
  FROM student
  JOIN jurusan ON student.major_id = jurusan.id_jurusan
  JOIN fakultas ON student.faculty_id = fakultas.id_fakultas
  " . ($keyword ? "WHERE student.full_name LIKE '%$keyword%'" : "") . "
  ORDER BY student.full_name ASC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-3">
      <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-9 p-4">
      <h3>Status Penerimaan Mahasiswa</h3>

      <!-- Form Pencarian -->
      <form method="GET" class="mb-3 d-flex">
        <input type="text" class="form-control me-2" name="keyword" placeholder="Cari nama mahasiswa..." value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit" class="btn btn-secondary">Cari</button>
      </form>

      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Fakultas</th>
            <th>Jurusan</th>
            <th>Status</th>
            <th>Verifikasi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($mahasiswa) > 0): $no = 1; ?>
            <?php while($m = mysqli_fetch_assoc($mahasiswa)): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= htmlspecialchars($m['full_name']) ?></td>
              <td><?= htmlspecialchars($m['nama_fakultas']) ?></td>
              <td><?= htmlspecialchars($m['nama_jurusan']) ?></td>
              <td><?= $m['status_penerimaan'] ?? '-' ?></td>
              <td>
                <form method="POST" class="d-flex">
                  <input type="hidden" name="id" value="<?= $m['id'] ?>">
                  <select name="status" class="form-select me-2">
                    <option value="Belum Diterima" <?= ($m['status_penerimaan'] == 'Belum Diterima') ? 'selected' : '' ?>>Belum Diterima</option>
                    <option value="Lolos Seleksi" <?= ($m['status_penerimaan'] == 'Lolos Seleksi') ? 'selected' : '' ?>>Lolos Seleksi</option>
                    <option value="Ditolak" <?= ($m['status_penerimaan'] == 'Ditolak') ? 'selected' : '' ?>>Ditolak</option>
                  </select>
                  <button type="submit" name="verifikasi" class="btn btn-primary btn-sm">Simpan</button>
                </form>
              </td>
            </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="6" class="text-center">Data tidak ditemukan.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
