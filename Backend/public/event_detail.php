<?php
require_once "../includes/db_connection.php";

header("Content-Type: application/json");

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "Event Id Not Found"]);
    exit;
}

$id_event = intval($_GET['id']);

$sql = "SELECT * FROM events WHERE id_event = $id_event";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    echo json_encode(["error" => "Event Not Found"]);
    exit;
}

$event = mysqli_fetch_assoc($result);

// Tambahkan poster URL ke FRONTEND
$event['poster_url'] = "/OursEvent/Frontend/assets/img/" . $event['poster'];

// Tambahkan id_event agar bisa dipakai Buy Ticket
$event['id_event'] = $id_event;

echo json_encode($event);
exit;
?>
