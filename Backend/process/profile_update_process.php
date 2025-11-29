<?php
/*
========================================================
PROFILE UPDATE PROCESS
File ini menerima POST dari frontend (profile.html)
yang mengirim:
- nama_lengkap
- no_hp
- password_baru (optional)

BACKEND harus melakukan:
1. Ambil id_user dari session
2. Jika password baru KOSONG → update hanya nama & no_hp
3. Jika password baru DIISI → hash dulu, baru update
4. Redirect balik ke profile.php
========================================================
*/

require_once "../includes/db_connection.php";
require_once "../includes/session_check.php";

$id_user = $_SESSION["id_user"];

$nama_lengkap  = $_POST["username"] ?? "";
$no_hp         = $_POST["no_hp"] ?? "";
$password_baru = $_POST["password_baru"] ?? "";

// Backend implement logic UPDATE user

if (empty($password_baru)) {
    // =====================================================
    // PASSWORD TIDAK DIUBAH
    // =====================================================
    $sql = "UPDATE users 
            SET username = ?, no_hp = ?
            WHERE id_user = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $username, $no_hp, $id_user);

} else {
    // =====================================================
    // PASSWORD DIUBAH → Hash dulu
    // =====================================================
    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

    $sql = "UPDATE users 
            SET username = ?, no_hp = ?, password = ?
            WHERE id_user = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $username, $no_hp, $password_hash, $id_user);
}

// Eksekusi query
if (mysqli_stmt_execute($stmt)) {
    // Berhasil → kembali ke profile
    header("Location: ../public/profile.php");
    exit();
} else {
    echo "Update gagal: " . mysqli_error($conn);
}

?>
