<?php
session_start();
header("Content-Type: application/json");

// Jika belum login
if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

require_once __DIR__ . "/../includes/db_connection.php";

$id_user = $_SESSION['user_id'];

$sql = "
    SELECT 
        p.id_daftar,
        p.id_user,
        p.jumlah_tiket,
        p.total_biaya,
        p.status,
        e.id_event,
        e.judul_event,
        e.tanggal,
        e.jam,
        e.lokasi,
        e.harga,
        e.poster,
        u.username,
        u.institusi
    FROM pendaftaran_event p
    JOIN events e ON p.id_event = e.id_event
    JOIN users u ON p.id_user = u.id_user
    WHERE p.id_user = ?
    AND p.status IN ('Paid')
";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_user);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
exit;
?>
