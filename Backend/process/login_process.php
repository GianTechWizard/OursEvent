<?php

session_start();
session_unset();
session_destroy();

if (ini_get("session.use_cookies")) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $p["path"], $p["domain"], $p["secure"], $p["httponly"]
    );
}

session_start();

require_once "../includes/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../Frontend/pages/login.html?error=invalid_method");
    exit();
}

$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if ($email === "" || $password === "") {
    header("Location: ../../Frontend/pages/login.html?error=empty");
    exit();
}

$sql = "SELECT id_user, username, email, password, role FROM users WHERE email = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$user) {
    session_unset();
    session_destroy();
    header("Location: ../../Frontend/pages/login.html?error=notfound");
    exit();
}

if (!password_verify($password, $user['password'])) {
    session_unset();
    session_destroy();
    header("Location: ../../Frontend/pages/login.html?error=wrongpassword");
    exit();
}

$_SESSION["user_id"] = $user["id_user"];
$_SESSION["username"] = $user["username"];
$_SESSION["email"] = $user["email"];
$_SESSION["role"] = $user["role"];

header("Location: ../../Frontend/pages/index.html");
exit();
?>





