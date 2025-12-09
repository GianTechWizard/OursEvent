<?php

ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header("Content-Type: application/json; charset=utf-8");

if (!isset($_SESSION['user_id'])) {
    if (ob_get_length()) { ob_end_clean(); }
    http_response_code(401);
    echo json_encode(["error" => "not_logged_in"]);
    exit;
}

require_once "../includes/db_connection.php";

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

mysqli_stmt_close($stmt);

if (ob_get_length()) { ob_end_clean(); }

if (!$userData) {
    http_response_code(404);
    echo json_encode(["error" => "user_not_found"]);
    exit;
}

echo json_encode($userData);
exit;
?>