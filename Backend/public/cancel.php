<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

require_once __DIR__ . "/../includes/db_connection.php";

$data = json_decode(file_get_contents("php://input"), true);
$daftar_ids = $data["daftar_ids"] ?? [];

if (empty($daftar_ids)) {
    echo json_encode(["success" => false, "message" => "Missing IDs"]);
    exit;
}

$id_user = $_SESSION['user_id'];

$daftar_ids = array_map("intval", $daftar_ids);
$id_list = implode(",", $daftar_ids);

$sql = "
    UPDATE pendaftaran_event
    SET status = 'Cancelled'
    WHERE id_user = $id_user
    AND id_daftar IN ($id_list)
";

$ok = mysqli_query($conn, $sql);

echo json_encode([
    "success" => $ok ? true : false,
    "updated_ids" => $daftar_ids,
    "debug" => [
        "id_user" => $id_user,
        "sql" => $sql
    ]
]);
exit;
?>