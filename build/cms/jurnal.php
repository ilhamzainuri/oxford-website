<?php
include '../../db-connection/koneksi.php';

// Upload Jurnal
if (isset($_POST['upload'])) {
  $title = $_POST['title'];
  $author = $_POST['author'];
  $year = $_POST['year'];
  $field = $_POST['field'];

  // Upload file
  $file = $_FILES['file']['name'];
  $tmp = $_FILES['file']['tmp_name'];
  $uploadDir = '../../uploads/jurnal/';
  $filePath = $uploadDir . basename($file);

  if (move_uploaded_file($tmp, $filePath)) {
    $url = 'uploads/jurnal/' . $file;
    mysqli_query($conn, "INSERT INTO journals (title, author, year, field, file_url) VALUES ('$title', '$author', '$year', '$field', '$url')");
    header("Location: jurnal.php?success=1");
    exit;
  } else {
    echo "<div class='alert alert-danger'>Upload gagal.</div>";
  }
}

// Hapus Jurnal
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT file_url FROM journals WHERE id = $id"));
  if ($data) {
    $filepath = '../../' . $data['file_url'];
    if (file_exists($filepath)) unlink($filepath);
    mysqli_query($conn, "DELETE FROM journals WHERE id = $id");
  }
  header("Location: jurnal.php");
  exit;
}

// Ambil data
$jurnal = mysqli_query($conn, "SELECT * FROM journals ORDER BY year DESC, title ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kelola Jurnal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-3">
      <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-9 p-4">
      <h3>Upload Jurnal Baru</h3>
      <form method="POST" enctype="multipart/form-data" class="row g-2 mb-4">
        <div class="col-md-6"><input type="text" name="title" class="form-control" placeholder="Judul Jurnal" required></div>
        <div class="col-md-6"><input type="text" name="author" class="form-control" placeholder="Nama Penulis" required></div>
        <div class="col-md-3">
          <select name="year" class="form-select" required>
            <option disabled selected>Tahun</option>
            <?php for ($y = date('Y'); $y >= 2000; $y--): ?>
              <option value="<?= $y ?>"><?= $y ?></option>
            <?php endfor; ?>
          </select>
        </div>
        <div class="col-md-4">
          <select name="field" class="form-select" required>
            <option disabled selected>Bidang</option>
            <option value="Education">Education</option>
            <option value="Health">Health</option>
            <option value="Technology">Technology</option>
            <option value="Economy">Economy</option>
            <option value="Social">Social</option>
          </select>
        </div>
        <div class="col-md-5"><input type="file" name="file" class="form-control" required></div>
        <div class="col-md-12">
          <button type="submit" name="upload" class="btn btn-primary">Upload</button>
        </div>
      </form>

      <h4>Daftar Jurnal</h4>
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Tahun</th>
            <th>Bidang</th>
            <th>File</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; while ($row = mysqli_fetch_assoc($jurnal)): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= htmlspecialchars($row['author']) ?></td>
            <td><?= $row['year'] ?></td>
            <td><?= $row['field'] ?></td>
            <td><a href="../../<?= $row['file_url'] ?>" target="_blank">Download</a></td>
            <td>
              <a href="edit_jurnal.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="jurnal.php?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus jurnal ini?')" class="btn btn-sm btn-danger">Hapus</a>
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
