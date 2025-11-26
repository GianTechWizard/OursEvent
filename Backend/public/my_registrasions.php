<?php
    require_once "../includes/db_connection.php";
    require_once "../includes/session_check.php";

    $id = $_SESSION ['user_id'];

    $sql = "SELECT pendaftaran_event . * , events. judul_event 
    FROM pendaftaran_event p
    JOIN events e ON pendaftaran_event . id_event = events . id_event
    WHERE pendaftaran_event . id_user = '$id'";

    $data = mysqli_query ($conn, $sql);

    //  FRONTEND:
    // tampilkan list pendaftaran event


?>