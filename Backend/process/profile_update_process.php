<?php

// require_once "../includes/db_connection.php";
// require_once "../includes/session_check.php";

// $id_user = $_SESSION["user_id"];

// $username  = $_POST["username"] ?? "";
// $no_hp         = $_POST["no_hp"] ?? "";
// $institusi = $_POST["institusi"] ?? "";

// // Backend implement logic UPDATE user

// if (empty($password_baru)) {
//     // =====================================================
//     // PASSWORD TIDAK DIUBAH
//     // =====================================================
//     $sql = "UPDATE users 
//             SET username = ?, no_hp = ?
//             WHERE id_user = ?";
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, "ssi", $username, $no_hp, $id_user);

// } else {
//     // =====================================================
//     // PASSWORD DIUBAH → Hash dulu
//     // =====================================================
//     $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

//     $sql = "UPDATE users 
//             SET username = ?, no_hp = ?, password = ?
//             WHERE id_user = ?";
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, "sssi", $username, $no_hp, $password_hash, $id_user);
// }

// // Eksekusi query
// if (mysqli_stmt_execute($stmt)) {
//     // Berhasil → kembali ke profile
//     header("Location: ../public/profile.php");
//     exit();
// } else {
//     echo "Update gagal: " . mysqli_error($conn);
// }

    require_once "../includes/db_connection.php";
require_once "../includes/session_check.php"; // session sudah dimulai di sini

// session_check.php memastikan session sudah ada dan user_id tersedia
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Frontend/pages/login.html?error=not_logged_in");
    exit();
}

$id_user = $_SESSION['user_id'];

// Ambil data POST (tanpa ternary)
$username = "";
if (isset($_POST['username'])) { $username = trim($_POST['username']); }

$no_hp = "";
if (isset($_POST['no_hp'])) { $no_hp = trim($_POST['no_hp']); }

$email = "";
if (isset($_POST['email'])) { $email = trim($_POST['email']); }

$institusi = "";
if (isset($_POST['institusi'])) { $institusi = trim($_POST['institusi']); }

// Prepared UPDATE
$sql = "UPDATE users SET username = ?, no_hp = ?, email = ?, institusi = ? WHERE id_user = ?";

$stmt = mysqli_prepare($conn, $sql);
if ($stmt === false) {
    header("Location: ../../Frontend/pages/edit_profile.html?error=server");
    exit();
}
mysqli_stmt_bind_param($stmt, "ssssi", $username, $no_hp, $email, $institusi, $id_user);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: ../../Frontend/pages/profile.html?success=updated");
    exit();
} else {
    mysqli_stmt_close($stmt);
    header("Location: ../../Frontend/pages/edit_profile.html?error=update_failed");
    exit();
}
?>

