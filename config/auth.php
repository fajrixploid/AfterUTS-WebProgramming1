
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Project base URL
$scriptDir = str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"]));

if (in_array(
    basename($scriptDir),
    ["pages", "crud", "crud-media", "proses"],
    true
)) {
    $projectBase = dirname($scriptDir);
} else {
    $projectBase = $scriptDir;
}

$projectBase = rtrim($projectBase, "/");

if (!isset($_SESSION["user_id"])) {
    header("Location: " . $projectBase . "/pages/login.php");
    exit;
}
?>
