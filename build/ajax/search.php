<?php
include '../../db-connection/koneksi.php';

$keyword = mysqli_real_escape_string($conn, $_POST['keyword'] ?? '');

$query = "
SELECT student.*, jurusan.nama_jurusan, fakultas.nama_fakultas
FROM student
JOIN jurusan ON student.major_id = jurusan.id_jurusan
JOIN fakultas ON student.faculty_id = fakultas.id_fakultas
WHERE student.full_name LIKE '%$keyword%'
ORDER BY student.full_name ASC
";

$result = mysqli_query($conn, $query);
$no = 1;

if (mysqli_num_rows($result) > 0) {
  while ($m = mysqli_fetch_assoc($result)) {
    echo "<tr>
      <td>{$no}</td>
      <td>" . htmlspecialchars($m['full_name']) . "</td>
      <td>{$m['nama_fakultas']}</td>
      <td>{$m['nama_jurusan']}</td>
      <td>" . ($m['status_penerimaan'] ?? '-') . "</td>
      <td>
        <form method='POST' class='d-flex'>
          <input type='hidden' name='id' value='{$m['id']}'>
          <select name='status' class='form-select me-2'>
            <option value='Diproses' " . ($m['status_penerimaan'] == 'Diproses' ? 'selected' : '') . ">Diproses</option>
            <option value='Lolos Seleksi' " . ($m['status_penerimaan'] == 'Lolos Seleksi' ? 'selected' : '') . ">Lolos Seleksi</option>
            <option value='Tidak Lolos' " . ($m['status_penerimaan'] == 'Tidak Lolos' ? 'selected' : '') . ">Tidak Lolos</option>
          </select>
          <button type='submit' name='verifikasi' class='btn btn-primary btn-sm'>Simpan</button>
        </form>
      </td>
    </tr>";
    $no++;
  }
} else {
  echo "<tr><td colspan='6' class='text-center text-muted'>Tidak ada hasil ditemukan.</td></tr>";
}
