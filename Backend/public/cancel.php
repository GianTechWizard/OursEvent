<!-- Pembatalan Pendaftaran Event -->

<?php
    session_start();

    require_once "../includes/db_connect.php";

    //memastikan user sudah login 
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../public/login.php");
        exit();
    }

    $id_daftar = $_SESSION["user_id"];

    //Menghapus data user
    $sql = "DELETE FROM pendaftaran_event WHERE id_daftar
            = '$id_daftar' AND id_user = '{$_SESSION['user_id']}'";
            
    mysqli_query($conn, $sql);

    header("Location: my_registrasions.php");
    exit();

?>