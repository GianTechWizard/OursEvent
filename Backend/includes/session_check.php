<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

        echo json_encode(["error" => "not_logged_in"]);
        exit();
    }

    header("Location: ../../Frontend/pages/login.html");
    exit();
}
?>