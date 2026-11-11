<?php
require_once __DIR__ . "/../config/auth.php";
require_once __DIR__ . "/../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../pages/form_mahasiswa.php");
    exit;
}

$nim = trim($_POST["nim"] ?? "");
$nama = trim($_POST["nama"] ?? "");
$program_studi = trim($_POST["program_studi"] ?? "");
$email = trim($_POST["email"] ?? "");

if (
    $nim === "" ||
    $nama === "" ||
    $program_studi === "" ||
    $email === ""
) {
    die("Semua field wajib diisi.");
}

$stmt = $conn->prepare(
    "INSERT INTO mahasiswa (nim, nama, program_studi, email)
    VALUES (?, ?, ?, ?)"
);

if (!$stmt) {
    die("Gagal menyiapkan query: " . $conn->error);
}

$stmt->bind_param(
    "ssss",
    $nim,
    $nama,
    $program_studi,
    $email
);

if (!$stmt->execute()) {
    die("Gagal menyimpan data: " . $stmt->error);
}

$stmt->close();
$conn->close();

header("Location: ../pages/data_mahasiswa.php?status=sukses");
exit;
?>