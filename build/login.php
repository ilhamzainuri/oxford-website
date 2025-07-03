<?php
session_start();
include '../db-connection/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $student = mysqli_query($conn, "SELECT * FROM student WHERE username='$username' AND password='$password'");
    
    if ($student && mysqli_num_rows($student) === 1) {
        $data = mysqli_fetch_assoc($student);
        $_SESSION['username'] = $data['username'];
        $_SESSION['full_name'] = $data['full_name'];
        $_SESSION['student_id'] = $data['id'];
        header("Location: lms/dashboard.php");
        exit;
    }


    $admin = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    
    if ($admin && mysqli_num_rows($admin) === 1) {
        $data = mysqli_fetch_assoc($admin);
        $_SESSION['admin_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        header("Location: cms/admin.php");
        exit;
    }

    echo "<script>alert('Username atau Password salah'); window.location.href='login.php';</script>";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-image: url('../build/img/bg1.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="col-md-4">
        <div class="card shadow">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">Login</h3>
          <form method="post" action="login.php">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required />
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
              </div>
              <button type="submit" class="btn btn-primary w-100">Login</button>
            <a href="index.php" class="btn btn-secondary w-100 mt-2">Back</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
