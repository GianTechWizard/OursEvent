<?php
require_once "../includes/db_connection.php";
require_once "../includes/session_check.php"; 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../Frontend/pages/login.html?error=not_logged_in");
    exit();
}

$id_user = $_SESSION['user_id'];

$username = "";
if (isset($_POST['username'])) { $username = trim($_POST['username']); }

$no_hp = "";
if (isset($_POST['no_hp'])) { $no_hp = trim($_POST['no_hp']); }

$email = "";
if (isset($_POST['email'])) { $email = trim($_POST['email']); }

$institusi = "";
if (isset($_POST['institusi'])) { $institusi = trim($_POST['institusi']); }

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

