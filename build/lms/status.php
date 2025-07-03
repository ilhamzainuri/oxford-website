<?php
include '../../db-connection/koneksi.php';

$username = $_SESSION['username'];
$query = mysqli_query($conn, "SELECT status_penerimaan FROM student WHERE username='$username'");
$data = mysqli_fetch_assoc($query);
$status = $data['status_penerimaan'];
?>

<h4>Status Penerimaan</h4>
<div class="alert 
  <?= $status === 'Lolos Seleksi' ? 'alert-success' : ($status === 'Ditolak' ? 'alert-danger' : 'alert-warning') ?>">
  <strong>Status Anda:</strong> <?= $status ?>
</div>

<?php if ($status === 'Lolos Seleksi'): ?>
  <p>Selamat! Anda telah diterima di Universitas Oxford. Silakan menunggu informasi lanjutan terkait orientasi dan jadwal perkuliahan.</p>
<?php elseif ($status === 'Belum Diterima'): ?>
  <p>Permohonan Anda sedang dalam proses peninjauan. Silakan cek kembali nanti.</p>
<?php else: ?>
  <p>Mohon maaf, Anda belum lolos seleksi. Terima kasih telah mendaftar.</p>
<?php endif; ?>
