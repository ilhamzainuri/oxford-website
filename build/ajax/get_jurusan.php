<?php
include '../../db-connection/koneksi.php';


if (!isset($_GET['faculty_id'])) {
    echo "<option disabled>faculty_id tidak diberikan</option>";
    exit;
}

$faculty_id = intval($_GET['faculty_id']);
echo "<!-- Debug: faculty_id = $faculty_id -->"; // ← debug output ke browser

$query = "SELECT id_jurusan, nama_jurusan FROM jurusan WHERE id_fakultas = $faculty_id ORDER BY nama_jurusan ASC";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "<option disabled>SQL Error: " . mysqli_error($conn) . "</option>";
    exit;
}

if (mysqli_num_rows($result) === 0) {
    echo "<option disabled>No majors found</option>";
    exit;
}

echo '<option selected disabled>Select major</option>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="' . $row['id_jurusan'] . '">' . $row['nama_jurusan'] . '</option>';
}
?>
