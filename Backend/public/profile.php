<?php
    require_once "../includes/db_connection.php";   
    require_once "../includes/session_check.php";

    $id = $_SESSION ['user.id'];

    $sql = mysqli_query ($conn, "SELECT * FROM users WHERE id_user='$id'");
    $user = mysqli_fetch_assoc($sql);

    //  FRONTEND:
    // tampilkan form update profile
    // action → ../process/profile_update_process.php
?>