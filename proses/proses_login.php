<?php
session_start();
require_once __DIR__ . "/../config/koneksi.php";
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
 header("Location: ../pages/login.php");
 exit;
}
$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";
$stmt = $conn->prepare(
 "SELECT id, username, password_hash, nama_lengkap
 FROM users WHERE username = ? LIMIT 1"
 );
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user && password_verify($password, $user["password_hash"])) {
 session_regenerate_id(true);
 $_SESSION["user_id"] = $user["id"];
 $_SESSION["username"] = $user["username"];
 $_SESSION["nama_lengkap"] = $user["nama_lengkap"];
 header("Location: ../pages/dashboard.php");
 exit;
}
header("Location: ../pages/login.php?error=1");
exit;
?>