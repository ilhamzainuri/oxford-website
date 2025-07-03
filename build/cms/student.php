<?php
include '../../db-connection/koneksi.php';

$id_fakultas = $_GET['id_fakultas'] ?? '';
$id_jurusan = $_GET['id_jurusan'] ?? '';
$keyword = $_GET['keyword'] ?? '';
$where = [];

if (!empty($id_fakultas)) {
  $where[] = "student.faculty_id = '" . mysqli_real_escape_string($conn, $id_fakultas) . "'";
}
if (!empty($id_jurusan)) {
  $where[] = "student.major_id = '" . mysqli_real_escape_string($conn, $id_jurusan) . "'";
}
if (!empty($keyword)) {
  $where[] = "student.full_name LIKE '%" . mysqli_real_escape_string($conn, $keyword) . "%'";
}

$filter_sql = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';

$fakultas = mysqli_query($conn, "SELECT * FROM fakultas ORDER BY nama_fakultas ASC");
$jurusan = mysqli_query($conn, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");

if (isset($_POST['tambah'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $domicile = mysqli_real_escape_string($conn, $_POST['domicile']);
  $school = mysqli_real_escape_string($conn, $_POST['school']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
  $major = mysqli_real_escape_string($conn, $_POST['major']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $cek = mysqli_query($conn, "SELECT id FROM student WHERE username = '$username'");
  if (mysqli_num_rows($cek) > 0) {
    echo "<div class='alert alert-danger'>Username sudah digunakan.</div>";
  } else {
    $insert = mysqli_query($conn, "INSERT INTO student 
      (full_name, domicile, previous_school, phone_number, email, faculty_id, major_id, username, password)
      VALUES ('$name', '$domicile', '$school', '$phone', '$email', '$faculty', '$major', '$username', '$password')");
    if ($insert) {
      header("Location: student.php");
      exit;
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
}

if (isset($_GET['hapus'])) {
  $id = mysqli_real_escape_string($conn, $_GET['hapus']);
  mysqli_query($conn, "DELETE FROM student WHERE id = '$id'");
  header("Location: student.php");
  exit;
}

if (isset($_POST['edit'])) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $domicile = mysqli_real_escape_string($conn, $_POST['domicile']);
  $school = mysqli_real_escape_string($conn, $_POST['school']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $faculty = mysqli_real_escape_string($conn, $_POST['faculty']);
  $major = mysqli_real_escape_string($conn, $_POST['major']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $update = mysqli_query($conn, "UPDATE student SET 
    full_name='$name', domicile='$domicile', previous_school='$school',
    phone_number='$phone', email='$email', faculty_id='$faculty',
    major_id='$major', username='$username', password='$password' 
    WHERE id='$id'");

  if ($update) {
    header("Location: student.php");
    exit;
  }
}

$mahasiswa = mysqli_query($conn, "
  SELECT student.*, fakultas.nama_fakultas, jurusan.nama_jurusan
  FROM student
  JOIN fakultas ON fakultas.id_fakultas = student.faculty_id
  JOIN jurusan ON jurusan.id_jurusan = student.major_id
  $filter_sql
  ORDER BY full_name ASC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3 bg-light p-3">
      <?php include 'sidebar.php'; ?>
    </div>
    <div class="col-md-9 p-4">
      <h3>Data Mahasiswa</h3>

      <form method="GET" class="row g-2 mb-3">
        <div class="col-md-3">
          <select name="id_fakultas" class="form-select" onchange="this.form.submit()">
            <option value="">-- Semua Fakultas --</option>
            <?php while ($f = mysqli_fetch_assoc($fakultas)): ?>
              <option value="<?= $f['id_fakultas'] ?>" <?= $id_fakultas == $f['id_fakultas'] ? 'selected' : '' ?>><?= $f['nama_fakultas'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-3">
          <select name="id_jurusan" class="form-select" onchange="this.form.submit()">
            <option value="">-- Semua Jurusan --</option>
            <?php mysqli_data_seek($jurusan, 0); while ($j = mysqli_fetch_assoc($jurusan)): ?>
              <option value="<?= $j['id_jurusan'] ?>" <?= $id_jurusan == $j['id_jurusan'] ? 'selected' : '' ?>><?= $j['nama_jurusan'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-4">
          <input type="text" name="keyword" class="form-control" placeholder="Cari nama mahasiswa..." value="<?= htmlspecialchars($keyword) ?>">
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-secondary w-100">Cari</button>
        </div>
      </form>

      <form method="POST" class="row g-2 mb-4">
        <div class="col-md-3"><input type="text" name="name" class="form-control" placeholder="Nama" required></div>
        <div class="col-md-2"><input type="text" name="domicile" class="form-control" placeholder="Domisili" required></div>
        <div class="col-md-2"><input type="text" name="school" class="form-control" placeholder="Asal Sekolah" required></div>
        <div class="col-md-2"><input type="text" name="phone_number" class="form-control" placeholder="Telepon" required></div>
        <div class="col-md-3"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
        <div class="col-md-3">
          <select name="faculty" class="form-select" required>
            <option disabled selected>Pilih Fakultas</option>
            <?php mysqli_data_seek($fakultas, 0); while ($f = mysqli_fetch_assoc($fakultas)): ?>
              <option value="<?= $f['id_fakultas'] ?>"><?= $f['nama_fakultas'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-3">
          <select name="major" class="form-select" required>
            <option disabled selected>Pilih Jurusan</option>
            <?php mysqli_data_seek($jurusan, 0); while ($j = mysqli_fetch_assoc($jurusan)): ?>
              <option value="<?= $j['id_jurusan'] ?>"><?= $j['nama_jurusan'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="col-md-3"><input type="text" name="username" class="form-control" placeholder="Username" required></div>
        <div class="col-md-3"><input type="text" name="password" class="form-control" placeholder="Password" required></div>
        <div class="col-md-12"><button type="submit" name="tambah" class="btn btn-success">Tambah Mahasiswa</button></div>
      </form>

      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Domisili</th>
            <th>Sekolah</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Fakultas</th>
            <th>Jurusan</th>
            <th>Username</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($mahasiswa) > 0): $no = 1; while ($m = mysqli_fetch_assoc($mahasiswa)): ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($m['full_name']) ?></td>
            <td><?= htmlspecialchars($m['domicile']) ?></td>
            <td><?= htmlspecialchars($m['previous_school']) ?></td>
            <td><?= htmlspecialchars($m['phone_number']) ?></td>
            <td><?= htmlspecialchars($m['email']) ?></td>
            <td><?= $m['nama_fakultas'] ?></td>
            <td><?= $m['nama_jurusan'] ?></td>
            <td><?= $m['username'] ?></td>
            <td><a href="?hapus=<?= $m['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</a></td>
          </tr>
          <?php endwhile; else: ?>
          <tr><td colspan="10" class="text-center">Data tidak ditemukan</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
