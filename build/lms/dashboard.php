<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
$username = $_SESSION['username'];
$full_name = $_SESSION['full_name'];
$page = isset($_GET['page']) ? $_GET['page'] : 'status';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
    }
    .sidebar {
      width: 220px;
      height: 100vh;
      background-color: #0d6efd;
      color: white;
      padding: 20px;
    }
    .sidebar a {
      display: block;
      color: white;
      margin: 15px 0;
      text-decoration: none;
    }
    .sidebar a:hover {
      text-decoration: underline;
    }
    .content {
      flex-grow: 1;
      padding: 30px;
      background-color: #f8f9fa;
    }
  </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="content">
<?php
if ($page === 'profile') {
    include 'profile.php';
} elseif ($page === 'status') {
    include 'status.php';
} elseif ($page === 'pilih_mapel') {
    include 'pilih_mapel.php';
} else {
    echo "<p>Halaman tidak ditemukan.</p>";
}
?>
</div>

</body>
</html>
