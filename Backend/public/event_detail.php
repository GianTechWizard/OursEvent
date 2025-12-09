<?php
require_once "../includes/db_connection.php";

header("Content-Type: application/json");

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "Event ID missing"]);
    exit;
}

$id_event = intval($_GET['id']);

$sql = "SELECT * FROM events WHERE id_event = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_event);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (!$result || mysqli_num_rows($result) === 0) {
    echo json_encode(["error" => "Event not found"]);
    exit;
}

$event = mysqli_fetch_assoc($result);

// Poster URL path ke frontend
$event['poster_url'] = "/OursEvent/Frontend/assets/img/" . $event['poster'];

echo json_encode($event);
exit;
?>
