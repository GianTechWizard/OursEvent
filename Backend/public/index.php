<?php
session_start();
header('Content-Type: application/json');

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

require_once "../includes/db_connection.php";
require_once "../includes/functions.php";

// Ambil user ID dari session
$userId = $_SESSION['user_id'];

// Ambil event yang pernah didaftarkan user
$events = getUserRegisteredEvents($conn, $userId);

$dataEvent = [];

while ($row = mysqli_fetch_assoc($events)) {
    $dataEvent[] = $row;
}

echo json_encode($dataEvent);
exit;
?>
