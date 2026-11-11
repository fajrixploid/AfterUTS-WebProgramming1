<?php
require_once "../config/auth.php";
require_once "../config/koneksi.php";
$sql = "SELECT id, nim, nama, program_studi, email
 FROM mahasiswa
 ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>CRUD Mahasiswa</title>
 <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<header>
 <h1>CRUD Mahasiswa</h1>
 <p>Web Programming 1</p>
</header>
<nav>
<a href="../pages/dashboard.php">Dashboard</a>
 <a href="../pages/index.php">Biodata</a>
 <a href="../pages/layout.php">Layout Lab</a>
 <a href="../pages/data_mahasiswa.php">Data Mahasiswa</a>
 <a href="../pages/form_mahasiswa.php">Tambah Mahasiswa</a>
 <a href="index.php">CRUD Mahasiswa</a>
 <a href="../proses/logout.php">Logout</a>
</nav>

    <main>
<section>
 <div class="crud-toolbar">
 <a class="btn" href="tambah.php">+ Tambah Data</a>
 <input type="search" id="searchMahasiswa" placeholder="Cari NIM, nama, prodi, email...">
 </div>
 <table class="data-table" id="crudTable">
 <thead>
 <tr>
 <th>No</th>
 <th>NIM</th>
 <th>Nama</th>
 <th>Program Studi</th>
 <th>Email</th>
 <th>Action</th>
 </tr>
 </thead>
 <tbody>
 <?php $no = 1; ?>
 <?php while ($row = $result->fetch_assoc()): ?>
 <tr>
 <td><?= $no++; ?></td>
 <td><?= htmlspecialchars($row["nim"]); ?></td>
 <td><?= htmlspecialchars($row["nama"]); ?></td>
 <td><?= htmlspecialchars($row["program_studi"]); ?></td>
 <td><?= htmlspecialchars($row["email"]); ?></td>
 <td class="actions">
    <a href="edit.php?id=<?= $row["id"]; ?>">Edit</a>
 <form action="../proses/proses_hapus.php"
 method="POST"
class="delete-form">
 <input type="hidden" name="id" value="<?= $row["id"]; ?>">
<button type="submit" class="btn-delete">Hapus</button>
 </form>
 </td>
 </tr>
 <?php endwhile; ?>
 </tbody>
 </table>
</section>
</main>
<script src="../assets/js/crud.js"></script>
</body>
</html>