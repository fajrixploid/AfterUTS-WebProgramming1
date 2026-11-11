
<?php

require_once __DIR__ . "/../../config/auth.php";
require_once __DIR__ . "/../../config/koneksi.php";
require_once __DIR__ . "/../../config/media_helper.php";

$root = dirname(__DIR__, 2);

$uploadedFiles = [];

try {

    $nim = trim($_POST["nim"] ?? "");
    $nama = trim($_POST["nama"] ?? "");
    $programStudi = trim($_POST["program_studi"] ?? "");
    $email = trim($_POST["email"] ?? "");

    if (
        $nim === "" ||
        $nama === "" ||
        $programStudi === "" ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        throw new RuntimeException("Data mahasiswa tidak valid.");
    }

    $foto = uploadMedia(
        $_FILES["foto"],
        [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/webp" => "webp"
        ],
        2 * 1024 * 1024,
        $root . "/uploads/images",
        "foto"
    );

    if ($foto) $uploadedFiles[] = ["images", $foto];

    $audio = uploadMedia(
        $_FILES["audio"],
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

    if ($audio) $uploadedFiles[] = ["audio", $audio];

    $dokumen = uploadMedia(
        $_FILES["dokumen"],
        [
            "application/pdf" => "pdf"
        ],
        2 * 1024 * 1024,
        $root . "/uploads/documents",
        "dokumen"
    );

    if ($dokumen) $uploadedFiles[] = ["documents", $dokumen];

    $stmt = $conn->prepare(
        "INSERT INTO mahasiswa
        (nim, nama, program_studi, email, foto, audio, dokumen)
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "sssssss",
        $nim,
        $nama,
        $programStudi,
        $email,
        $foto,
        $audio,
        $dokumen
    );

    if (!$stmt->execute()) {
        throw new RuntimeException("Gagal menyimpan data.");
    }

    $stmt->close();

    header("Location: ../../crud-media/index.php?status=tambah");
    exit;

} catch (Throwable $e) {

    // Hapus file yang sudah terupload jika penyimpanan gagal.
    foreach ($uploadedFiles as [$folder, $filename]) {
        hapusMediaJikaAda(
            $filename,
            $root . "/uploads/" . $folder
        );
    }

    error_log($e->getMessage());

    http_response_code(400);
    echo "Gagal menyimpan data: " .
         htmlspecialchars($e->getMessage());
}
