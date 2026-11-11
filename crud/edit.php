<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";
$id = (int) ($_GET["id"] ?? 0);
if ($id <= 0) {
 die("ID tidak valid.");
}
$stmt = $conn->prepare(
 "SELECT id, nim, nama, program_studi, email
 FROM mahasiswa
 WHERE id = ?
 LIMIT 1"
 );
$stmt->bind_param("i", $id);
$stmt->execute();
$mahasiswa = $stmt->get_result()->fetch_assoc();
if (!$mahasiswa) {
 die("Data mahasiswa tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Edit Mahasiswa</title>
 <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header><h1>Edit Mahasiswa</h1></header>
<main>
<section>
<form class="crud-form"
 data-crud-form
 action="../proses/proses_update.php"
 method="POST"
 novalidate>
 <input type="hidden" name="id" value="<?= $mahasiswa["id"]; ?>">
 <label for="nim">NIM</label>
 <input id="nim" name="nim" type="text"
 value="<?= htmlspecialchars($mahasiswa["nim"]); ?>">
 <small class="form-error" id="errorNim"></small>
 <label for="nama">Nama</label>
 <input id="nama" name="nama" type="text"
 value="<?= htmlspecialchars($mahasiswa["nama"]); ?>">
 <small class="form-error" id="errorNama"></small>
 <label for="program_studi">Program Studi</label>
 <input id="program_studi" name="program_studi" type="text"
 value="<?= htmlspecialchars($mahasiswa["program_studi"]); ?>">
 <small class="form-error" id="errorProdi"></small>
 <label for="email">Email</label>
 <input id="email" name="email" type="email"
 value="<?= htmlspecialchars($mahasiswa["email"]); ?>">
 <small class="form-error" id="errorEmail"></small>
 <button type="submit">Update Data</button>
 <a href="index.php">Batal</a>
</form>
</section>
</main>
<script src="../assets/js/crud.js"></script>
</body>
</html>