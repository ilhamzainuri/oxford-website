<?php
include '../../db-connection/koneksi.php';

$username = $_SESSION['username'];
$query = mysqli_query($conn, "SELECT * FROM student WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

// Proses update profil
if (isset($_POST['update'])) {
    $name     = $_POST['name'];
    $domicile = $_POST['domicile'];
    $school   = $_POST['school'];
    $phone    = $_POST['phone'];
    $email    = $_POST['email'];


    if ($_FILES['foto']['name']) {
        $target_dir = "upload/";
        $foto_name = time() . "_" . basename($_FILES["foto"]["name"]);
        $target_file = $target_dir . $foto_name;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
        
        // Simpan data + foto
        mysqli_query($conn, "UPDATE student SET 
            full_name='$name', domicile='$domicile', previous_school='$school', 
            phone_number='$phone', email='$email', foto='$foto_name' 
            WHERE username='$username'");
    } else {
        mysqli_query($conn, "UPDATE student SET 
            full_name='$name', domicile='$domicile', previous_school='$school', 
            phone_number='$phone', email='$email' 
            WHERE username='$username'");
    }

    echo "<script>alert('Profil berhasil diperbarui'); window.location.href='dashboard.php?page=profile';</script>";
}
?>

<h4>Profil Mahasiswa</h4>
<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label>Full Name</label>
    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($data['full_name'], ENT_QUOTES) ?>"required>
  </div>
  <div class="mb-3">
    <label>Domicile</label>
    <input type="text" name="domicile" class="form-control" value="<?= htmlspecialchars($data['domicile'], ENT_QUOTES) ?>" required>
  </div>
  <div class="mb-3">
    <label>Previous School</label>
    <input type="text" name="school" class="form-control" value="<?= htmlspecialchars($data['previous_school'], ENT_QUOTES) ?>" required>
  </div>
  <div class="mb-3">
    <label>Phone</label>
    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($data['phone_number'], ENT_QUOTES) ?>" required>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email'], ENT_QUOTES) ?>" required>
  </div>
  <div class="mb-3">
    <label>Photo</label><br>
    <?php if ($data['foto']): ?>
      <img src="upload/<?= $data['foto'] ?>" width="100" class="mb-2"><br>
    <?php endif; ?>
    <input type="file" name="foto" class="form-control">
  </div>
  <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
</form>
