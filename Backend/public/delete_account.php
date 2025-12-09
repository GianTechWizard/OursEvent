<?php
// session_start();
// header("Content-Type: application/json");

// if (!isset($_SESSION['user_id'])) {
//     echo json_encode(["success" => false, "message" => "Unauthorized"]);
//     exit;
// }

// require_once "../includes/db_connection.php";

// $id_user = intval($_SESSION['user_id']);

// $sql1 = "DELETE FROM pendaftaran_event WHERE id_user = ?";
// $stmt1 = mysqli_prepare($conn, $sql1);
// mysqli_stmt_bind_param($stmt1, "i", $id_user);
// mysqli_stmt_execute($stmt1);

// $sql2 = "DELETE FROM users WHERE id_user = ?";
// $stmt2 = mysqli_prepare($conn, $sql2);
// mysqli_stmt_bind_param($stmt2, "i", $id_user);
// mysqli_stmt_execute($stmt2);

// $affected = mysqli_stmt_affected_rows($stmt2);

// if ($affected > 0) {

//     session_unset();
//     session_destroy();

//     if (ini_get("session.use_cookies")) {
//         $p = session_get_cookie_params();
//         setcookie(session_name(), '', time() - 42000,
//             $p["path"], $p["domain"], $p["secure"], $p["httponly"]
//         );
//     }

//     echo json_encode(["success" => true]);
// } else {
//     echo json_encode(["success" => false, "message" => "Delete failed"]);
// }

// exit;



session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Unauthorized"]);
    exit;
}

require_once "../includes/db_connection.php";

$id_user = intval($_SESSION['user_id']);

// Hapus seluruh pendaftaran event user
$sql1 = "DELETE FROM pendaftaran_event WHERE id_user = ?";
$stmt1 = mysqli_prepare($conn, $sql1);
mysqli_stmt_bind_param($stmt1, "i", $id_user);
mysqli_stmt_execute($stmt1);

// Hapus akun user
$sql2 = "DELETE FROM users WHERE id_user = ?";
$stmt2 = mysqli_prepare($conn, $sql2);
mysqli_stmt_bind_param($stmt2, "i", $id_user);
mysqli_stmt_execute($stmt2);

$affected = mysqli_stmt_affected_rows($stmt2);

if ($affected > 0) {

    // Bersihkan session
    session_unset();
    session_destroy();

    // Hapus cookie session di browser
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Delete failed"]);
}

exit;
?>




