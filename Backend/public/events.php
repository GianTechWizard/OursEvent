<?php
require_once "../includes/db_connection.php";

header("Content-Type: application/json");

$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {

    $row['poster_url'] = "/OursEvent/Frontend/assets/img/" . $row['poster'];

    $data[] = $row;
}

echo json_encode($data);
exit;
?>
