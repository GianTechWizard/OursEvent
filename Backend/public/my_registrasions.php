<?php

require_once "../includes/db_connection.php";
require_once "../includes/session_check.php"; 

// pengecekkan session_check untuk memastikan user harus login dulu (ISI CODE SINI- MARCEL)
$id_user = $_SESSION['id_user'];

// proses Pengambilan semua event yang sudah didaftarkan oleh user (ISI CODE SINI- MARCEL)
$sql = "SELECT p.*, e.judul_event FROM pendaftaran_event p
        JOIN events e ON p.id_event = e.id_event
        WHERE id_user = ?";

// Tanda "?" adalah placeholder yang nanti diganti dengan id_user dari session

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
exit;
 

//tes berubah apa gitu
?>
