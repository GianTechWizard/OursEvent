<!-- Pembatalan Pendaftaran Event -->

<?php
    session_start();

    require_once "../includes/db_connect.php";

    //memastikan user sudah login 
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../public/login.php");
        exit();
    }

    $id_daftar = $$_GET["id_daftar"];
    $id_user   = $_SESSION['id_user'];    // ID user yang login

    // Query DELETE (menghapus hanya jika pendaftarannya milik user yang sama)
    $sql = "DELETE FROM pendaftaran_event 
            WHERE id_daftar = '$id_daftar' 
            AND id_user = '$id_user'";   

    mysqli_query($conn, $sql);

    header("Location: my_registrasions.php");
    exit();

?>