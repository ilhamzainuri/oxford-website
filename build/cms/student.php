<?php
include '../../db-connection/koneksi.php';

// Filter
$id_fakultas = $_GET['id_fakultas'] ?? '';
$id_jurusan = $_GET['id_jurusan'] ?? '';
$where = [];

if (!empty($id_fakultas)) {
  $where[] = "student.faculty_id = '" . mysqli_real_escape_string($conn, $id_fakultas) . "'";
}
if (!empty($id_jurusan)) {
  $where[] = "student.major_id = '" . mysqli_real_escape_string($conn, $id_jurusan) . "'";
}

$filter_sql = '';
if (count($where) > 0) {
  $filter_sql = 'WHERE ' . implode(' AND ', $where);
}

// Ambil data fakultas dan jurusan terlebih dahulu
$fakultas_query = "SELECT * FROM fakultas ORDER BY nama_fakultas ASC";
$fakultas = mysqli_query($conn, $fakultas_query);

if (!empty($id_fakultas)) {
  $jurusan_query = "SELECT * FROM jurusan WHERE id_fakultas = '" . mysqli_real_escape_string($conn, $id_fakultas) . "' ORDER BY nama_jurusan ASC";
  $jurusan = mysqli_query($conn, $jurusan_query);
} else {
  $jurusan_query = "SELECT * FROM jurusan ORDER BY nama_jurusan ASC";
  $jurusan = mysqli_query($conn, $jurusan_query);
}

// Tambah Mahasiswa
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

  $insert_query = "INSERT INTO student (full_name, domicile, previous_school, phone_number, email, faculty_id, major_id, username, password) 
                   VALUES ('$name', '$domicile', '$school', '$phone', '$email', '$faculty', '$major', '$username', '$password')";
  
  if (mysqli_query($conn, $insert_query)) {
    header("Location: mahasiswa.php");
    exit;
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}

// Hapus Mahasiswa
if (isset($_GET['hapus'])) {
  $id = mysqli_real_escape_string($conn, $_GET['hapus']);
  $delete_query = "DELETE FROM student WHERE id = '$id'";
  if (mysqli_query($conn, $delete_query)) {
    header("Location: mahasiswa.php");
    exit;
  }
}

// Edit Mahasiswa
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

  $update_query = "UPDATE student SET full_name='$name', domicile='$domicile', previous_school='$school', phone_number='$phone', email='$email', faculty_id='$faculty', major_id='$major', username='$username', password='$password' WHERE id='$id'";
  
  if (mysqli_query($conn, $update_query)) {
    header("Location: mahasiswa.php");
    exit;
  }
}

// Ambil data mahasiswa dengan filter
$mahasiswa_query = "
SELECT student.*, jurusan.nama_jurusan, fakultas.nama_fakultas
FROM student
JOIN jurusan ON student.major_id = jurusan.id_jurusan
JOIN fakultas ON student.faculty_id = fakultas.id_fakultas
$filter_sql
ORDER BY student.full_name ASC
";
$mahasiswa = mysqli_query($conn, $mahasiswa_query);

// Buat array untuk dropdown agar tidak konflik dengan pointer mysqli
$fakultas_array = [];
$jurusan_array = [];

// Reset pointer dan buat array fakultas
mysqli_data_seek($fakultas, 0);
while ($f = mysqli_fetch_assoc($fakultas)) {
  $fakultas_array[] = $f;
}

// Reset pointer dan buat array jurusan
mysqli_data_seek($jurusan, 0);
while ($j = mysqli_fetch_assoc($jurusan)) {
  $jurusan_array[] = $j;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-3">
        <?php include 'sidebar.php'; ?>
      </div>
      <div class="col-9 p-4">
        <h3>Data Mahasiswa</h3>

        <!-- Filter Fakultas dan Jurusan -->
        <form method="GET" class="row g-2 mb-4">
          <div class="col-md-3">
            <select name="id_fakultas" class="form-select" onchange="this.form.submit()">
              <option value="">-- Semua Fakultas --</option>
              <?php foreach ($fakultas_array as $f): 
                $selected = ($id_fakultas == $f['id_fakultas']) ? 'selected' : '';
              ?>
                <option value="<?= $f['id_fakultas'] ?>" <?= $selected ?>><?= $f['nama_fakultas'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-3">
            <select name="id_jurusan" class="form-select" onchange="this.form.submit()">
              <option value="">-- Semua Jurusan --</option>
              <?php foreach ($jurusan_array as $j):
                $selected = ($id_jurusan == $j['id_jurusan']) ? 'selected' : '';
              ?>
                <option value="<?= $j['id_jurusan'] ?>" <?= $selected ?>><?= $j['nama_jurusan'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </form>

        <!-- Form Tambah Mahasiswa -->
        <form method="POST" class="row g-2 mb-4" id="formTambah">
          <div class="col-md-3"><input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required></div>
          <div class="col-md-2"><input type="text" name="domicile" class="form-control" placeholder="Domisili" required></div>
          <div class="col-md-2"><input type="text" name="school" class="form-control" placeholder="Asal Sekolah" required></div>
          <div class="col-md-2"><input type="text" name="phone_number" class="form-control" placeholder="Telepon" required></div>
          <div class="col-md-3"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
          <div class="col-md-3">
            <select name="faculty" id="fakultas_tambah" class="form-select" required>
              <option disabled selected>Pilih Fakultas</option>
              <?php foreach ($fakultas_array as $f): ?>
                <option value="<?= $f['id_fakultas'] ?>"><?= $f['nama_fakultas'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-3">
            <select name="major" id="jurusan_tambah" class="form-select" required disabled>
              <option disabled selected>Pilih Jurusan</option>
            </select>
          </div>
          <div class="col-md-3"><input type="text" name="username" class="form-control" placeholder="Username" required></div>
          <div class="col-md-3"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
          <div class="col-md-12"><button type="submit" name="tambah" class="btn btn-success">Tambah Mahasiswa</button></div>
        </form>

        <!-- Tabel Mahasiswa -->
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
            <?php 
            if (mysqli_num_rows($mahasiswa) > 0) {
              $no = 1;
              while ($m = mysqli_fetch_assoc($mahasiswa)): 
            ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($m['full_name']) ?></td>
                <td><?= htmlspecialchars($m['domicile']) ?></td>
                <td><?= htmlspecialchars($m['previous_school']) ?></td>
                <td><?= htmlspecialchars($m['phone_number']) ?></td>
                <td><?= htmlspecialchars($m['email']) ?></td>
                <td><?= htmlspecialchars($m['nama_fakultas']) ?></td>
                <td><?= htmlspecialchars($m['nama_jurusan']) ?></td>
                <td><?= htmlspecialchars($m['username']) ?></td>
                <td>
                  <a href="?hapus=<?= $m['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                  <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $m['id'] ?>">Edit</button>
                  
                  <!-- Modal Edit -->
                  <div class="modal fade" id="editModal<?= $m['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Edit Mahasiswa</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="POST">
                          <div class="modal-body">
                            <input type="hidden" name="id" value="<?= $m['id'] ?>">
                            <div class="mb-3">
                              <label class="form-label">Nama Lengkap</label>
                              <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($m['full_name']) ?>" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Domisili</label>
                              <input type="text" name="domicile" class="form-control" value="<?= htmlspecialchars($m['domicile']) ?>" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Asal Sekolah</label>
                              <input type="text" name="school" class="form-control" value="<?= htmlspecialchars($m['previous_school']) ?>" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Telepon</label>
                              <input type="text" name="phone_number" class="form-control" value="<?= htmlspecialchars($m['phone_number']) ?>" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Email</label>
                              <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($m['email']) ?>" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Fakultas</label>
                              <select name="faculty" id="fakultas_edit_<?= $m['id'] ?>" class="form-select fakultas-edit" required data-student-id="<?= $m['id'] ?>">
                                <?php foreach ($fakultas_array as $f): ?>
                                  <option value="<?= $f['id_fakultas'] ?>" <?= ($f['id_fakultas'] == $m['faculty_id']) ? 'selected' : '' ?>><?= $f['nama_fakultas'] ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Jurusan</label>
                              <select name="major" id="jurusan_edit_<?= $m['id'] ?>" class="form-select" required>
                                <?php foreach ($jurusan_array as $j): ?>
                                  <option value="<?= $j['id_jurusan'] ?>" <?= ($j['id_jurusan'] == $m['major_id']) ? 'selected' : '' ?>><?= $j['nama_jurusan'] ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Username</label>
                              <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($m['username']) ?>" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Password</label>
                              <input type="password" name="password" class="form-control" value="<?= htmlspecialchars($m['password']) ?>" required>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php 
              endwhile;
            } else {
              echo "<tr><td colspan='10' class='text-center'>Tidak ada data mahasiswa</td></tr>";
            }
            ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Fungsi untuk load jurusan berdasarkan fakultas
    function loadJurusan(fakultasId, targetSelect, selectedJurusan = '') {
      if (fakultasId) {
        fetch(`get_jurusan.php?id_fakultas=${fakultasId}`)
          .then(response => response.json())
          .then(data => {
            let options = '<option disabled selected>Pilih Jurusan</option>';
            data.forEach(jurusan => {
              const selected = selectedJurusan == jurusan.id_jurusan ? 'selected' : '';
              options += `<option value="${jurusan.id_jurusan}" ${selected}>${jurusan.nama_jurusan}</option>`;
            });
            targetSelect.innerHTML = options;
            targetSelect.disabled = false;
          })
          .catch(error => {
            console.error('Error:', error);
            targetSelect.innerHTML = '<option disabled selected>Error loading jurusan</option>';
          });
      } else {
        targetSelect.innerHTML = '<option disabled selected>Pilih Jurusan</option>';
        targetSelect.disabled = true;
      }
    }

    // Event listener untuk form tambah mahasiswa
    document.getElementById('fakultas_tambah').addEventListener('change', function() {
      const jurusanSelect = document.getElementById('jurusan_tambah');
      loadJurusan(this.value, jurusanSelect);
    });

    // Event listener untuk form edit mahasiswa
    document.querySelectorAll('.fakultas-edit').forEach(select => {
      select.addEventListener('change', function() {
        const studentId = this.dataset.studentId;
        const jurusanSelect = document.getElementById(`jurusan_edit_${studentId}`);
        loadJurusan(this.value, jurusanSelect);
      });
    });
  </script>
</body>

</html>