<!-- HOME PAGE -->

<?php
    // Menghubungkan ke database (ISI CODE SINI - MARCEL)
    require_once "../includes/db_connection.php";

    // Memanggil fungsi-fungsi (ISI CODE SINI - MARCEL)
    require_once "../includes/functions.php";

    // Proses pengambilan semua event dari database (ISI CODE SINI - MARCEL)
    $events = getEvents($conn);

    $dataEvent = [];

    while($row = mysqli_fetch_assoc($events)) {
        $dataEvent[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($dataEvent);
    exit;
?>