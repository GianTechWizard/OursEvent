  <?php
    require_once "../includes/db_connection.php";
    require_once "../includes/session_check.php";

    if (!isAdmin()) 
        exit;
    
    // proses pengambilan kategori
    $kategori = mysqli_query($conn,"SELECT * FROM kategori_event");

    ?>

<!-- Bagian FRONTEND:
form tambah event
POST ke ../process/event_add_process.php -->