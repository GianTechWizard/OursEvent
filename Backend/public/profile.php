<?php
// ====================================================================
// Bagian backend
// --------------------------------------------------------------------
// Fungsi file ini:
// 1. Mengecek apakah user sudah login (session_check.php)
// 2. Mengambil data user dari database
// 3. Mengirimkan data ini ke FRONTEND (UI form profile)
//
// CATATAN:
// Frontend akan membuat FORM HTML di bagian BODY file ini.
// Backend TIDAK membuat tampilan, hanya menyediakan data.
//
// UI akan mengirim update ke:
//   ../process/profile_update_process.php
// ====================================================================


// Menghubungkan ke database (ISI SINI - MARCEL)
require_once "../includes/db_connection.php";
require_once "../includes/session_check.php"; 

// Memanggil fungsi (ISI SINI - MARCEL)
 require_once "../includes/functions.php";

// Mengambil ID user dari session (ISI SINI - MARCEL)
$id_user = $_SESSION['id_user'];

// Query data user (ISI SINI - MARCEL)
$sql = "SELECT id_user, username, email, no_hp FROM users WHERE id_user = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id_user);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$userData = mysqli_fetch_assoc($result);

header("Content-Type: application/json");
echo json_encode($userData);
exit;








// --------------------------------------------------------------
// Bagian FRONTEND
// Buat UI form profil menggunakan HTML, contoh:
//
// <form action="../process/profile_update_process.php" method="POST">
//     <input type="text" name="nama" value="<?= $user['nama_lengkap'] ? >">
//     <input type="text" name="no_hp" value="<?= $user['no_hp'] ? >">
//     <input type="password" name="password">
//     <button type="submit">Update</button>
// </form>
//
// Backend tidak membuat UI.
// Backend hanya menyediakan $user untuk ditampilkan.
// --------------------------------------------------------------
?>
