<?php
require_once "../includes/db_connection.php";
require_once "../includes/session_check.php";

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to register for an event.");
}

$id_user = $_SESSION['user_id'];
$id_event = $_POST['id_event'] ?? 0;
$jumlah_tiket = $_POST['jumlah_tiket'] ?? 1;

if ($id_event <= 0 || $jumlah_tiket <= 0) {
    die("Invalid Data");
}

// Ambil harga event
$sql_harga = "SELECT harga FROM events WHERE id_event = ?";
$stmt_harga = $conn->prepare($sql_harga);
$stmt_harga->bind_param("i", $id_event);
$stmt_harga->execute();
$result_harga = $stmt_harga->get_result();

if ($result_harga->num_rows === 0) {
    die("Event Not Found");
}

$row_harga = $result_harga->fetch_assoc();
$harga = (int)$row_harga['harga']; 
$stmt_harga->close();

// Hitung total biaya
$total_biaya = $harga * $jumlah_tiket;

// --- FIX TERPENTING: UBAH "iiii" MENJADI "iiid"
$sql_insert = "INSERT INTO pendaftaran_event 
                (id_user, id_event, jumlah_tiket, total_biaya, status) 
                VALUES (?, ?, ?, ?, 'Paid')";

$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("iiid", $id_user, $id_event, $jumlah_tiket, $total_biaya);

if ($stmt_insert->execute()) {
    echo "success";
    exit;
} else {
    die("Error while saving registration: " . $stmt_insert->error);
}

$stmt_insert->close();
$conn->close();
?>
