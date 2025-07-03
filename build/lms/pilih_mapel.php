<?php
include '../../db-connection/koneksi.php';

$id_student = $_SESSION['student_id'] ?? null;

if (!$id_student) {
  echo "<div class='alert alert-danger'>Anda belum login.</div>";
  exit;
}

$query = "
SELECT s.*, j.nama_jurusan, f.nama_fakultas
FROM student s
JOIN jurusan j ON s.major_id = j.id_jurusan
JOIN fakultas f ON s.faculty_id = f.id_fakultas
WHERE s.id = $id_student
";
$student = mysqli_fetch_assoc(mysqli_query($conn, $query));

if (!$student) {
  echo "<div class='alert alert-warning'>Data mahasiswa tidak ditemukan.</div>";
  exit;
}

$major_id = $student['major_id'] ?? 0;
$fakultas = $student['nama_fakultas'] ?? '-';
$jurusan = $student['nama_jurusan'] ?? '-';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mapel'])) {
  $selected_mapel = $_POST['mapel'];

  mysqli_query($conn, "DELETE FROM minat_mahasiswa WHERE id_student = $id_student");

  foreach ($selected_mapel as $id_mapel) {
    mysqli_query($conn, "INSERT INTO minat_mahasiswa (id_student, id_mapel) VALUES ($id_student, $id_mapel)");
  }

  echo '<div class="alert alert-success">Minat berhasil disimpan.</div>';
}

$mapel = mysqli_query($conn, "SELECT * FROM mata_pelajaran WHERE id_jurusan = $major_id");

$minat_terpilih = [];
$cek = mysqli_query($conn, "SELECT id_mapel FROM minat_mahasiswa WHERE id_student = $id_student");
while ($m = mysqli_fetch_assoc($cek)) {
  $minat_terpilih[] = $m['id_mapel'];
}
?>

<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title">Informasi Mahasiswa</h5>
    <p class="card-text"><strong>Nama:</strong> <?= htmlspecialchars($student['full_name']) ?></p>
    <p class="card-text"><strong>Fakultas:</strong> <?= htmlspecialchars($fakultas) ?></p>
    <p class="card-text"><strong>Jurusan:</strong> <?= htmlspecialchars($jurusan) ?></p>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <h4 class="card-title mb-3">Pilih Mata Pelajaran Minat</h4>
    <form method="POST">
      <?php while ($m = mysqli_fetch_assoc($mapel)): ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="mapel[]" value="<?= $m['id_mapel'] ?>" 
            id="m<?= $m['id_mapel'] ?>" <?= in_array($m['id_mapel'], $minat_terpilih) ? 'checked' : '' ?>>
          <label class="form-check-label" for="m<?= $m['id_mapel'] ?>">
            <?= $m['nama_mapel'] ?>
          </label>
        </div>
      <?php endwhile; ?>
      <button type="submit" class="btn btn-success mt-3">Simpan Pilihan</button>
    </form>
  </div>
</div>
