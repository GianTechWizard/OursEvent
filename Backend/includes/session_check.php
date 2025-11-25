<!-- Mengamankan halaman yang butuh login -->

<?php
    session_start();

    if (isset($_SESSION['user_id'])){
        header("Location: ../login.php");
        exit;
    }

    // pengecekkan admin

    function isAdmin(){ 
        return isset($_SESSION["user_id"]) && $_SESSION["user_id"] == "admin";
    }

?>