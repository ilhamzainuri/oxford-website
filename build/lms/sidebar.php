<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../../db-connection/koneksi.php';

$id_student = $_SESSION['student_id'] ?? null;
$full_name = '';
$status = '';

if ($id_student) {
  $result = mysqli_query($conn, "SELECT full_name, status_penerimaan FROM student WHERE id = $id_student");
  if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $full_name = $data['full_name'];
    $status = $data['status_penerimaan'] ?? '';
  }
}
?>

<!-- Sidebar -->
<div class="bg-primary text-white p-3 rounded shadow" style="min-height: 100vh;">
  <h5 class="mb-3">
    👋 Welcome,<br><strong><?= htmlspecialchars($full_name) ?></strong>
  </h5>
  <hr class="border-light">

  <ul class="nav flex-column">
    <li class="nav-item mb-2">
      <a href="?page=profile" class="nav-link text-white d-flex align-items-center">
        <i class="bi bi-person-fill me-2"></i> Profil
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="?page=status" class="nav-link text-white d-flex align-items-center">
        <i class="bi bi-clipboard-check me-2"></i> Status Penerimaan
      </a>
    </li>
    <?php if ($status === 'Lolos Seleksi'): ?>
    <li class="nav-item mb-2">
      <a href="?page=pilih_mapel" class="nav-link text-white d-flex align-items-center">
        <i class="bi bi-book-half me-2"></i> Pilih Mapel
      </a>
    </li>
    <?php endif; ?>
    <li class="nav-item mt-3">
      <a href="logout.php" class="nav-link text-warning d-flex align-items-center">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
      </a>
    </li>
  </ul>
</div>
