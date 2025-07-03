<?php
include '../db-connection/koneksi.php';

$fakultas = mysqli_query($conn, "SELECT * FROM fakultas ORDER BY nama_fakultas ASC");

$jurusan = mysqli_query($conn, "
  SELECT jurusan.id_jurusan, jurusan.nama_jurusan, fakultas.nama_fakultas 
  FROM jurusan 
  JOIN fakultas ON jurusan.id_fakultas = fakultas.id_fakultas 
  ORDER BY jurusan.nama_jurusan ASC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Join Us - Oxford</title>
  <link href="../bootstrap-5.3.5-dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <link rel="stylesheet" href="../build/css/style.css" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .form-card {
      max-width: 500px;
      margin: auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>
<?php include 'navbar.html'; ?>

<header>
  <div id="mainCarousel" class="carousel slide container mt-5" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="row align-items-center">
          <div class="col-md-7">
            <h1 class="display-4">Join Our Community</h1>
            <p class="lead">Connect with students and faculty from around the world. Oxford offers a vibrant and inclusive environment for learning and growth.</p>
            <a href="#registration" class="btn btn-success btn-lg mt-3">Join Now</a>    
          </div>
          <div class="col-md-5 text-center">
            <img src="../build/img/img-main.png" alt="Woman holding books" class="img-fluid">
          </div>
        </div>
      </div>
      <!-- Add more slides if needed -->
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</header>

<section id="registration" class="py-5 bg-light">
  <div class="container">
    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Student Registration Form</h4>
      </div>
      <div class="card-body">
        <form action="proses_join.php" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="domicile" class="form-label">Domicile</label>
            <input type="text" name="domicile" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="school" class="form-label">Previous School</label>
            <input type="text" name="school" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="tel" name="phone" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
          <div class="mb-3">
  <label for="faculty" class="form-label">Faculty</label>
  <select name="faculty" id="faculty" class="form-select" required>
    <option selected disabled>Select faculty</option>
    <?php while($f = mysqli_fetch_assoc($fakultas)): ?>
      <option value="<?= $f['id_fakultas'] ?>"><?= $f['nama_fakultas'] ?></option>
    <?php endwhile; ?>
  </select>
</div>

<!-- Major (akan diisi otomatis oleh JS) -->
<div class="mb-3">
  <label for="major" class="form-label">Intended Major</label>
  <select name="major" id="major" class="form-select" required>

    <option selected disabled>Select major</option>
  </select>
</div>

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
document.getElementById('faculty').addEventListener('change', function () {
    let facultyId = this.value;
    if (!facultyId) return;
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'ajax/get_jurusan.php?faculty_id=' + facultyId, true);
    xhr.onload = function () {
        if (this.status === 200) {
            document.getElementById('major').innerHTML = this.responseText;
        } else {
            alert("Error loading majors");
        }
    };
    xhr.send();
});
</script>




<?php include 'footer.html'; ?>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="../bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
