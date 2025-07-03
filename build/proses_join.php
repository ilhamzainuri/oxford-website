<?php
include '../db-connection/koneksi.php'; // jika file ini berada di folder yang sama dengan joinus.php, gunakan 'db-connection/koneksi.php'

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $full_name = $_POST['name'];
    $domicile = $_POST['domicile'];
    $school = $_POST['school'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $faculty_id = $_POST['faculty'];
    $major_id = $_POST['major'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi data kosong
    if (empty($full_name) || empty($domicile) || empty($school) || empty($phone) || empty($email) ||
        empty($faculty_id) || empty($major_id) || empty($username) || empty($password)) {
        echo "<script>alert('Please complete all fields!'); window.history.back();</script>";
        exit;
    }

    // Cek apakah username atau email sudah digunakan
    $cek = mysqli_query($conn, "SELECT * FROM student WHERE username='$username' OR email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username or email already registered.'); window.history.back();</script>";
        exit;
    }

    // Simpan ke database
    $sql = "INSERT INTO student (full_name, domicile, previous_school, phone_number, email, faculty_id, major_id, username, password)
            VALUES ('$full_name', '$domicile', '$school', '$phone', '$email', '$faculty_id', '$major_id', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Registration successful! Please log in.'); window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('Access denied.'); window.location='joinus.php';</script>";
}
?>
