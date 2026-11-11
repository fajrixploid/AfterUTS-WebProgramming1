
<?php

require_once __DIR__ . "/../../config/auth.php";
require_once __DIR__ . "/../../config/koneksi.php";
require_once __DIR__ . "/../../config/media_helper.php";

$root = dirname(__DIR__, 2);
$uploadedFiles = [];

try {

    // 1. Ambil data form
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    $nim = trim($_POST["nim"] ?? "");
    $nama = trim($_POST["nama"] ?? "");
    $programStudi = trim($_POST["program_studi"] ?? "");
    $email = trim($_POST["email"] ?? "");

    if (
        !$id ||
        $nim === "" ||
        $nama === "" ||
        $programStudi === "" ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        throw new RuntimeException("Data tidak valid.");
    }

    // 2. Ambil data lama
    $stmt = $conn->prepare(
        "SELECT foto, audio, dokumen
         FROM mahasiswa WHERE id = ?"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $oldData = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$oldData) {
        throw new RuntimeException("Data mahasiswa tidak ditemukan.");
    }

    // 3. Upload foto baru jika dipilih
    $foto = uploadMedia(
        $_FILES["foto"] ?? ["error" => UPLOAD_ERR_NO_FILE],
        [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/webp" => "webp"
        ],
        2 * 1024 * 1024,
        $root . "/uploads/images",
        "foto"
    );

    if ($foto !== null) {
        $uploadedFiles[] = ["images", $foto];
    } else {
        $foto = $oldData["foto"];
    }

    // 4. Upload audio baru jika dipilih
    $audio = uploadMedia(
        $_FILES["audio"] ?? ["error" => UPLOAD_ERR_NO_FILE],
        [
            "audio/mpeg" => "mp3",
            "audio/wav" => "wav",
            "audio/x-wav" => "wav",
            "audio/ogg" => "ogg"
        ],
        2 * 1024 * 1024,
        $root . "/uploads/audio",
        "audio"
    );

    if ($audio !== null) {
        $uploadedFiles[] = ["audio", $audio];
    } else {
        $audio = $oldData["audio"];
    }

    // 5. Upload dokumen baru jika dipilih
    $dokumen = uploadMedia(
        $_FILES["dokumen"] ?? ["error" => UPLOAD_ERR_NO_FILE],
        [
            "application/pdf" => "pdf"
        ],
        2 * 1024 * 1024,
        $root . "/uploads/documents",
        "dokumen"
    );

    if ($dokumen !== null) {
        $uploadedFiles[] = ["documents", $dokumen];
    } else {
        $dokumen = $oldData["dokumen"];
    }

    // 6. Update database
    $stmt = $conn->prepare(
        "UPDATE mahasiswa
         SET nim = ?, nama = ?, program_studi = ?,
             email = ?, foto = ?, audio = ?, dokumen = ?
         WHERE id = ?"
    );

    $stmt->bind_param(
        "sssssssi",
        $nim,
        $nama,
        $programStudi,
        $email,
        $foto,
        $audio,
        $dokumen,
        $id
    );

    if (!$stmt->execute()) {
        throw new RuntimeException("Gagal memperbarui database.");
    }

    $stmt->close();

    // 7. Hapus file lama hanya setelah database berhasil diupdate
    if ($foto !== $oldData["foto"]) {
        hapusMediaJikaAda(
            $oldData["foto"],
            $root . "/uploads/images"
        );
    }

    if ($audio !== $oldData["audio"]) {
        hapusMediaJikaAda(
            $oldData["audio"],
            $root . "/uploads/audio"
        );
    }

    if ($dokumen !== $oldData["dokumen"]) {
        hapusMediaJikaAda(
            $oldData["dokumen"],
            $root . "/uploads/documents"
        );
    }

    header("Location: ../../crud-media/index.php?status=update");
    exit;

} catch (Throwable $e) {

    // Bersihkan file baru jika proses gagal
    foreach ($uploadedFiles as [$folder, $filename]) {
        hapusMediaJikaAda(
            $filename,
            $root . "/uploads/" . $folder
        );
    }

    error_log($e->getMessage());

    http_response_code(400);

    echo "Gagal memperbarui data: " .
         htmlspecialchars($e->getMessage());
}
