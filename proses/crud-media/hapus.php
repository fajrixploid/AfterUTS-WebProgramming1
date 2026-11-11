
<?php

require_once __DIR__ . "/../../config/auth.php";
require_once __DIR__ . "/../../config/koneksi.php";
require_once __DIR__ . "/../../config/media_helper.php";

$root = dirname(__DIR__, 2);

try {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if (!$id) {
        throw new RuntimeException("ID tidak valid.");
    }

    // Ambil nama file media
    $stmt = $conn->prepare(
        "SELECT foto, audio, dokumen
         FROM mahasiswa WHERE id = ?"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $data = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$data) {
        throw new RuntimeException("Data tidak ditemukan.");
    }

    // Hapus data mahasiswa dari database
    $stmt = $conn->prepare(
        "DELETE FROM mahasiswa WHERE id = ?"
    );

    $stmt->bind_param("i", $id);

    if (!$stmt->execute()) {
        throw new RuntimeException("Gagal menghapus data.");
    }

    $stmt->close();

    // Hapus file media setelah database berhasil
    hapusMediaJikaAda(
        $data["foto"],
        $root . "/uploads/images"
    );

    hapusMediaJikaAda(
        $data["audio"],
        $root . "/uploads/audio"
    );

    hapusMediaJikaAda(
        $data["dokumen"],
        $root . "/uploads/documents"
    );

    header("Location: ../../crud-media/index.php?status=hapus");
    exit;

} catch (Throwable $e) {

    error_log($e->getMessage());

    http_response_code(400);

    echo "Gagal menghapus data: " .
         htmlspecialchars($e->getMessage());
}
