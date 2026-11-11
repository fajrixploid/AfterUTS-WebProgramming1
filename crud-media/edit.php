
<?php
require_once __DIR__ . "/../config/auth.php";
require_once __DIR__ . "/../config/koneksi.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    die("ID mahasiswa tidak valid.");
}

$stmt = $conn->prepare(
    "SELECT * FROM mahasiswa WHERE id = ?"
);

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$mahasiswa = $result->fetch_assoc();

$stmt->close();

if (!$mahasiswa) {
    die("Data mahasiswa tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Media</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h1>Edit Data Media</h1>
    <p>Perbarui data mahasiswa dan file media</p>
</header>

<main>
<section>

    <form
        action="../proses/crud-media/update.php"
        method="POST"
        enctype="multipart/form-data"
        data-media-form
    >

        <input type="hidden" name="id"
               value="<?= (int) $mahasiswa['id']; ?>">

        <label>NIM</label>
        <input type="text" id="nim" name="nim"
               value="<?= htmlspecialchars($mahasiswa['nim']); ?>"
               required>
        <small id="errorNim" class="form-error"></small>

        <label>Nama</label>
        <input type="text" id="nama" name="nama"
               value="<?= htmlspecialchars($mahasiswa['nama']); ?>"
               required>
        <small id="errorNama" class="form-error"></small>

        <label>Program Studi</label>
        <input type="text" id="program_studi"
               name="program_studi"
               value="<?= htmlspecialchars($mahasiswa['program_studi']); ?>"
               required>
        <small id="errorProdi" class="form-error"></small>

        <label>Email</label>
        <input type="email" id="email" name="email"
               value="<?= htmlspecialchars($mahasiswa['email']); ?>"
               required>
        <small id="errorEmail" class="form-error"></small>

        <hr>

        <h3>Foto Saat Ini</h3>

        <?php if (!empty($mahasiswa['foto'])): ?>
            <img
                src="../uploads/images/<?= rawurlencode($mahasiswa['foto']); ?>"
                width="150"
                alt="Foto mahasiswa"
            >
        <?php else: ?>
            <p>Belum ada foto.</p>
        <?php endif; ?>

        <label>Ganti Foto</label>
        <input type="file" id="foto" name="foto"
               accept="image/jpeg,image/png,image/webp">

        <img id="previewFoto"
             class="media-preview-image"
             alt="Preview foto baru"
             hidden>

        <h3>Audio Saat Ini</h3>

        <?php if (!empty($mahasiswa['audio'])): ?>
            <audio controls>
                <source src="../uploads/audio/<?= rawurlencode($mahasiswa['audio']); ?>">
            </audio>
        <?php else: ?>
            <p>Belum ada audio.</p>
        <?php endif; ?>

        <label>Ganti Audio</label>
        <input type="file" id="audio" name="audio"
               accept="audio/*">

        <audio id="previewAudio"
               controls hidden></audio>

        <h3>Dokumen Saat Ini</h3>

        <?php if (!empty($mahasiswa['dokumen'])): ?>
            <a target="_blank"
               rel="noopener"
               href="../uploads/documents/<?= rawurlencode($mahasiswa['dokumen']); ?>">
                Buka PDF Saat Ini
            </a>
        <?php else: ?>
            <p>Belum ada dokumen.</p>
        <?php endif; ?>

        <label>Ganti Dokumen PDF</label>
        <input type="file" id="dokumen" name="dokumen"
               accept="application/pdf">

        <p id="previewDokumen">
            Belum ada dokumen baru dipilih.
        </p>

        <button type="submit">Update Data</button>
        <a href="index.php">Kembali</a>

    </form>

</section>
</main>

<script src="../assets/js/media.js"></script>

</body>
</html>
