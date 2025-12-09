<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

require_once "../includes/db_connection.php";
require_once "../includes/functions.php";

$userId = $_SESSION['user_id'];

$events = getUserRegisteredEvents($conn, $userId);

$dataEvent = [];

while ($row = mysqli_fetch_assoc($events)) {
    $dataEvent[] = $row;
}

echo json_encode($dataEvent);
exit;
?>
