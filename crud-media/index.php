
<?php
require_once __DIR__ . "/../config/auth.php";
require_once __DIR__ . "/../config/koneksi.php";

$sql = "SELECT id, nim, nama, program_studi, email, foto, audio, dokumen
        FROM mahasiswa
        ORDER BY id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Media</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<header>
    <h1>CRUD Media</h1>
    <p>Web Programming 1</p>
</header>

<nav>
    <a href="../pages/dashboard.php">Dashboard</a>
    <a href="../pages/index.php">Biodata</a>
    <a href="../pages/layout.php">Layout Lab</a>
    <a href="../pages/data_mahasiswa.php">Data Mahasiswa</a>
    <a href="../pages/form_mahasiswa.php">Tambah Mahasiswa</a>
    <a href="../crud/index.php">CRUD Mahasiswa</a>
    <a href="index.php">CRUD Media</a>
    <a href="../proses/logout.php">Logout</a>
</nav>

<main>
<section>

    <div class="crud-toolbar">
        <a class="btn" href="tambah.php">+ Tambah Data Media</a>

        <input
            type="search"
            id="searchMedia"
            placeholder="Cari NIM, nama, prodi, email..."
        >
    </div>

    <div class="table-scroll">
        <table class="data-table" id="mediaTable">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Program Studi</th>
                    <th>Email</th>
                    <th>Audio</th>
                    <th>Dokumen</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php $no = 1; ?>

                <?php while ($row = $result->fetch_assoc()): ?>

                <tr>
                    <td><?= $no++; ?></td>

                    <td>
                        <?php if (!empty($row["foto"])): ?>

                            <img
                                class="table-photo"
                                src="../uploads/images/<?= htmlspecialchars($row["foto"]); ?>"
                                alt="Foto <?= htmlspecialchars($row["nama"]); ?>"
                            >

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                    <td><?= htmlspecialchars($row["nim"]); ?></td>

                    <td><?= htmlspecialchars($row["nama"]); ?></td>

                    <td><?= htmlspecialchars($row["program_studi"]); ?></td>

                    <td><?= htmlspecialchars($row["email"]); ?></td>

                    <td>
                        <?php if (!empty($row["audio"])): ?>

                            <audio controls preload="none" class="table-audio">
                                <source src="../uploads/audio/<?= htmlspecialchars($row["audio"]); ?>">
                            </audio>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if (!empty($row["dokumen"])): ?>

                            <a
                                href="../uploads/documents/<?= htmlspecialchars($row["dokumen"]); ?>"
                                target="_blank"
                                rel="noopener"
                            >
                                Buka PDF
                            </a>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                    <td class="actions">

                        <a href="edit.php?id=<?= (int) $row["id"]; ?>">
                            Edit
                        </a>

                        <form
                            action="../proses/crud-media/hapus.php"
                            method="POST"
                            class="media-delete-form"
                        >

                            <input
                                type="hidden"
                                name="id"
                                value="<?= (int) $row["id"]; ?>"
                            >

                            <button type="submit" class="btn-delete">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

                <?php endwhile; ?>

            </tbody>

        </table>
    </div>

</section>
</main>

<script src="../assets/js/media.js"></script>

</body>
</html>
