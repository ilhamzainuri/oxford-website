<?php
include '../db-connection/koneksi.php';

if (isset($_GET['hapus']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
  $id = $_GET['hapus'];
  $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT file_url FROM jurnal WHERE id = $id"));
  if ($data) {
    $filepath = '../' . $data['file_url'];
    if (file_exists($filepath)) unlink($filepath);
    mysqli_query($conn, "DELETE FROM jurnal WHERE id = $id");
  }
  header("Location: research.php");
  exit;
}


$title = $_GET['title'] ?? '';
$author = $_GET['author'] ?? '';
$year = $_GET['year'] ?? '';
$field = $_GET['field'] ?? '';

$where = [];
if (!empty($title)) $where[] = "title LIKE '%$title%'";
if (!empty($author)) $where[] = "author LIKE '%$author%'";
if (!empty($year)) $where[] = "year = '$year'";
if (!empty($field)) $where[] = "field = '$field'";

$filter = (count($where) > 0) ? "WHERE " . implode(' AND ', $where) : "";

$jurnal = mysqli_query($conn, "SELECT * FROM journals $filter ORDER BY year DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Research & Journals - University of Oxford</title>
  <link href="../bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
        background-image: url('../build/img/bg2.jpg');  
    }
    .filter-section {
    background: rgba(255,255,255,0.7);
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .card:hover {
      transform: translateY(-5px);
      transition: 0.3s;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .section-title {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 30px;
      text-align: center;
    }
    footer {
      text-align: center;
      padding: 20px 0;
      margin-top: 60px;
      background-color: #f1f1f1;
    }
  </style>
</head>
<body>

<?php include 'navbar.html'; ?>
<!-- Main Content -->
<div class="container">
  <div class="section-title">Research & Journals Repository</div>

  <!-- Filter Form -->
  <div class="filter-section mb-5">
    <form>
      <div class="row g-3">
        <div class="col-md-4">
          <input type="text" name="title" class="form-control" placeholder="Search by Title">
        </div>
        <div class="col-md-4">
          <input type="text" name="author" class="form-control" placeholder="Search by Author">
        </div>
        <div class="col-md-2">
          <select name="year" class="form-select">
            <option value="">Year</option>
            <option value="2025">2025</option>
            <option value="2024">2024</option>
            <option value="2023">2023</option>
            <option value="2022">2022</option>
            <option value="2021">2021</option>
          </select>
        </div>
        <div class="col-md-2">
          <select name="field" class="form-select">
            <option value="">Field</option>
            <option value="Education">Education</option>
            <option value="Health">Health</option>
            <option value="Technology">Technology</option>
            <option value="Economy">Economy</option>
            <option value="Social">Social</option>
          </select>
        </div>
        <div class="col-12 text-end">
          <button type="submit" class="btn btn-primary">Search</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </div>
    </form>
  </div>

  <!-- Journal Cards -->
  <div class="row">
  <?php if (mysqli_num_rows($jurnal) > 0): ?>
    <?php while($j = mysqli_fetch_assoc($jurnal)): ?>
    <div class="col-md-4 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <h5 class="card-title"><?= htmlspecialchars($j['title']) ?></h5>
          <p class="card-text"><strong>Author:</strong> <?= htmlspecialchars($j['author']) ?></p>
          <p class="card-text"><strong>Year:</strong> <?= $j['year'] ?></p>
          <p class="card-text"><strong>Field:</strong> <?= htmlspecialchars($j['field']) ?></p>
          <a href="../<?= $j['file_url'] ?>" class="btn btn-outline-primary btn-sm" target="_blank">View Details</a>

          <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
  <div class="mt-2 d-flex gap-2">
  </div>
<?php endif; ?>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  <?php else: ?>
    <div class="col-12"><p class="text-muted">No journals found.</p></div>
  <?php endif; ?>
</div>



<script src="../bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.html'; ?>
<?php include 'loading.php'; ?>
</body>
</html>
