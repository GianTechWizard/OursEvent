<?php

// // Menghubungkan ke database (ISI SINI - MARCEL)
//     require_once "../includes/db_connection.php";
//     require_once "../includes/session_check.php"; 

// // Memanggil fungsi (ISI SINI - MARCEL)
//     require_once "../includes/functions.php";

// // Mengambil ID user dari session (ISI SINI - MARCEL)
//     $id_user = $_SESSION['user_id'];

// // Query data user (ISI SINI - MARCEL)
//     $sql = "SELECT username AS fullname, email, no_hp AS phone, institusi AS institution 
//         FROM users WHERE id_user = ?";
//     $stmt = mysqli_prepare($conn, $sql);

//     mysqli_stmt_bind_param($stmt, "i", $id_user);
//     mysqli_stmt_execute($stmt);

//     $result = mysqli_stmt_get_result($stmt);
//     $userData = mysqli_fetch_assoc($result);

//     header("Content-Type: application/json");
//     echo json_encode($userData);
//     exit;



// ob_start();
// header("Content-Type: application/json");

// session_start();

// // Cek login
// if (!isset($_SESSION['user_id'])) {
//     echo json_encode(["error" => "not_logged_in"]);
//     exit;
// }

// require_once "../includes/db_connection.php";

// // Ambil ID user
// $id_user = $_SESSION['user_id'];

// // Query data user
// $sql = "SELECT username AS fullname, email, no_hp AS phone, institusi AS institution 
//         FROM users WHERE id_user = ?";
// $stmt = mysqli_prepare($conn, $sql);

// mysqli_stmt_bind_param($stmt, "i", $id_user);
// mysqli_stmt_execute($stmt);

// $result = mysqli_stmt_get_result($stmt);
// $userData = mysqli_fetch_assoc($result);

// // Bersihkan output buffer sebelum kirim JSON
// ob_clean();
// echo json_encode($userData);
// exit;

ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Response header JSON
header("Content-Type: application/json; charset=utf-8");

// Jika belum login, kembalikan respons terstruktur
if (!isset($_SESSION['user_id'])) {
    // kosongkan buffer output yang tidak diinginkan
    if (ob_get_length()) { ob_end_clean(); }
    http_response_code(401);
    echo json_encode(["error" => "not_logged_in"]);
    exit;
}

require_once "../includes/db_connection.php";

// Pastikan $conn ada dan valid
if (!isset($conn)) {
    if (ob_get_length()) { ob_end_clean(); }
    http_response_code(500);
    echo json_encode(["error" => "db_connection_missing"]);
    exit;
}

$id_user = intval($_SESSION['user_id']);

$sql = "SELECT username AS fullname, email, no_hp AS phone, institusi AS institution 
        FROM users WHERE id_user = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt === false) {
    if (ob_get_length()) { ob_end_clean(); }
    http_response_code(500);
    echo json_encode(["error" => "prepare_failed"]);
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $id_user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$userData = mysqli_fetch_assoc($result);

// tutup statement
mysqli_stmt_close($stmt);

// Hapus semua output buffer (jika ada) agar hanya JSON yang dikirim
if (ob_get_length()) { ob_end_clean(); }

if (!$userData) {
    http_response_code(404);
    echo json_encode(["error" => "user_not_found"]);
    exit;
}

// Sukses: kirim data user
echo json_encode($userData);
exit;