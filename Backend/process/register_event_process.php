<?php
/*
========================================================
REGISTER EVENT PROCESS
Dikirim dari event_detail.html via POST

Data yang dikirim:
- id_event
- jumlah_tiket

BACKEND harus:
1. Ambil id_user dari session
2. Ambil harga event dari database (SELECT harga FROM events)
3. Hitung total_biaya = harga * jumlah_tiket
4. Insert ke tabel pendaftaran_event:
   - id_user
   - id_event
   - jumlah_tiket
   - total_biaya
   - status = 'Pending'
5. Redirect ke my_registrations.php
========================================================
*/

//  Backend implement INSERT pendaftaran event



require_once "../includes/db_connect.php";
require_once "../includes/session_check.php";

if (!isset($_SESSION['id_user'])) {
    die("Anda harus login untuk mendaftar event.");
}

$id_user = $_SESSION['id_user'];

$id_event = $_POST['id_event'] ?? 0;
$jumlah_tiket = $_POST['jumlah_tiket'] ?? 1;

if ($id_event <= 0 || $jumlah_tiket <= 0) {
    die("Data tidak valid.");
}

$sql_harga = "SELECT harga FROM events WHERE id_event = ?";
$stmt_harga = $conn->prepare($sql_harga);
$stmt_harga->bind_param("i", $id_event);
$stmt_harga->execute();
$result_harga = $stmt_harga->get_result();

if ($result_harga->num_rows === 0) {
    die("Event tidak ditemukan.");
}

$row_harga = $result_harga->fetch_assoc();
$harga = $row_harga['harga'];
$stmt_harga->close();

$total_biaya = $harga * $jumlah_tiket;

$sql_insert = "INSERT INTO pendaftaran_event 
                (id_user, id_event, jumlah_tiket, total_biaya, status) 
                VALUES (?, ?, ?, ?, 'Pending')";

$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("iiid", $id_user, $id_event, $jumlah_tiket, $total_biaya);

if ($stmt_insert->execute()) {
    header("Location: my_registrations.php");
    exit;
} else {
    die("Error saat menyimpan pendaftaran: " . $stmt_insert->error);
}

$stmt_insert->close();
$conn->close();
?>



