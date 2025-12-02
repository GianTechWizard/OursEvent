<?php

require_once "../includes/db_connect.php";
require_once "../includes/session_check.php"; 

require_once "../includes/functions.php";

if (!isset($_GET['id'])) {
    echo json_encode(["error" => "ID event tidak ditemukan"]);
    exit;
}

$id_event = $_GET['id'];

if ($id > 0) {
    $result = getEventById($mysqli, $id);
    if ($result && mysqli_num_rows($result) > 0) {
        $event = mysqli_fetch_assoc($result);
        echo "<h1>Detail Event</h1>";
        echo "<p>Name: " . htmlspecialchars($event['event_name']) . "</p>";
    } else {
        echo "Event tidak ditemukan.";
    }
} else {
    echo "ID event tidak valid atau tidak ada di URL.";
}

?>
