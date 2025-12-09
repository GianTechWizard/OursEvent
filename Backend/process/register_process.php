<?php

require_once "../includes/db_connection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../Frontend/pages/register.html?error=invalid_method");
    exit();
}

$username = "";
if (isset($_POST['username'])) { $username = trim($_POST['username']); }

$email = "";
if (isset($_POST['email'])) { $email = trim($_POST['email']); }

$no_hp = "";
if (isset($_POST['no_hp'])) { $no_hp = trim($_POST['no_hp']); }

$institusi = "";
if (isset($_POST['institusi'])) { $institusi = trim($_POST['institusi']); }

$password = "";
if (isset($_POST['password'])) { $password = $_POST['password']; }

$confirm_password = "";
if (isset($_POST['confirm_password'])) { $confirm_password = $_POST['confirm_password']; }

if ($username === "" || $email === "" || $no_hp === "" || $institusi === "" || $password === "") {
    header("Location: ../../Frontend/pages/register.html?error=empty");
    exit();
}

if ($password !== $confirm_password) {
    header("Location: ../../Frontend/pages/register.html?error=password_mismatch");
    exit();
}

$check_sql = "SELECT id_user FROM users WHERE email = ?";
$stmt_check = mysqli_prepare($conn, $check_sql);
if ($stmt_check === false) {
    header("Location: ../../Frontend/pages/register.html?error=server");
    exit();
}
mysqli_stmt_bind_param($stmt_check, "s", $email);
mysqli_stmt_execute($stmt_check);
$res_check = mysqli_stmt_get_result($stmt_check);
if (mysqli_num_rows($res_check) > 0) {
    mysqli_stmt_close($stmt_check);
    header("Location: ../../Frontend/pages/register.html?error=email_exists");
    exit();
}
mysqli_stmt_close($stmt_check);

// ====== Enkripsi password ======
$hashed = password_hash($password, PASSWORD_DEFAULT);

$insert_sql = "INSERT INTO users (username, email, password, no_hp, institusi, role, created_at)
               VALUES (?, ?, ?, ?, ?, 'users', NOW())";
$stmt_insert = mysqli_prepare($conn, $insert_sql);
if ($stmt_insert === false) {
    header("Location: ../../Frontend/pages/register.html?error=server");
    exit();
}
mysqli_stmt_bind_param($stmt_insert, "sssss", $username, $email, $hashed, $no_hp, $institusi);
$exec = mysqli_stmt_execute($stmt_insert);
mysqli_stmt_close($stmt_insert);

if ($exec) {
    header("Location: ../../Frontend/pages/login.html?success=registered");
    exit();
} else {
    header("Location: ../../Frontend/pages/register.html?error=failed");
    exit();
}
?>
