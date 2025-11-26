<?php
    require_once "../includes/db_connection.php";
    require_once "../includes/functions.php";

    $id = $_GET["id"];
    $events = getEventById($conn, $id);
    $data = mysqli_fetch_assoc($events);

    // FRONTEND:
    // tampilkan detail event
    // form pembelian tiket → POST ke register_event_process.php
?>