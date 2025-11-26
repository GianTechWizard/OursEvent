<!-- HOME PAGE -->

<?php
    require_once "../includes/db_connections.php";
    require_once "../includes/functions.php";

    $events = getEvents($conn);

    // FRONTEND:
    // tampilkan list event → gunakan looping PHP
    
?>
