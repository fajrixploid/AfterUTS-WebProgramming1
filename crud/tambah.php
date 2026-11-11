<?php
require_once "../config/auth.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Tambah Data CRUD</title>
 <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
 <h1>Tambah Data CRUD</h1>
 <p>Form baru khusus area CRUD</p>
</header>
<main>
<section>
<form class="crud-form"
 data-crud-form
 action="../proses/proses_crud_tambah.php"
 method="POST"
 novalidate>
 <label for="nim">NIM</label>
 <input id="nim" name="nim" type="text" required>
 <small class="form-error" id="errorNim"></small>
 <label for="nama">Nama</label>
 <input id="nama" name="nama" type="text" required>
 <small class="form-error" id="errorNama"></small>
 <label for="program_studi">Program Studi</label>
 <input id="program_studi" name="program_studi" type="text" required>
 <small class="form-error" id="errorProdi"></small>
 <label for="email">Email</label>
 <input id="email" name="email" type="email" required>
 <small class="form-error" id="errorEmail"></small>
 <button type="submit">Simpan Data</button>
 <a href="index.php">Batal</a>
</form>
</section>
</main>
<script src="../assets/js/crud.js"></script>
</body>
</html>