
<?php
require_once __DIR__ . "/../config/auth.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Media</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<header>
    <h1>Tambah Data Media</h1>
    <p>Form upload multimedia mahasiswa</p>
</header>

<main>
<section>

    <form
        action="../proses/crud-media/tambah.php"
        method="POST"
        enctype="multipart/form-data"
        data-media-form
    >

        <label for="nim">NIM</label>
        <input type="text" id="nim" name="nim" required>
        <small id="errorNim" class="form-error"></small>

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required>
        <small id="errorNama" class="form-error"></small>

        <label for="program_studi">Program Studi</label>
        <input type="text" id="program_studi"
               name="program_studi" required>
        <small id="errorProdi" class="form-error"></small>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <small id="errorEmail" class="form-error"></small>

        <hr>

        <h3>Upload Foto</h3>
        <input type="file" id="foto" name="foto"
               accept="image/jpeg,image/png,image/webp">
        <small id="errorFoto" class="form-error"></small>

        <div class="media-preview-box">
            <p>Preview Foto:</p>
            <img id="previewFoto"
                 class="media-preview-image"
                 alt="Preview foto"
                 hidden>
        </div>

        <h3>Upload Audio</h3>
        <input type="file" id="audio" name="audio"
               accept="audio/*">

        <div class="media-preview-box">
            <p>Preview Audio:</p>
            <audio id="previewAudio"
                   class="media-preview-audio"
                   controls hidden></audio>
        </div>

        <h3>Upload Dokumen PDF</h3>
        <input type="file" id="dokumen" name="dokumen"
               accept="application/pdf">

        <div class="media-preview-box">
            <p>Dokumen:</p>
            <span id="previewDokumen">
                Belum ada dokumen dipilih.
            </span>
        </div>

        <button type="submit">Simpan Data</button>

        <a href="index.php">Kembali</a>

    </form>

</section>
</main>

<script src="../assets/js/media.js"></script>

</body>
</html>
