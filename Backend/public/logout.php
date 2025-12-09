<?php
// session_start();
// session_unset();
// session_destroy();

// header("Location: /OursEvent/Frontend/pages/login.html");
// exit();

session_start();
session_unset();
session_destroy();

// Hapus cookie session di browser
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

header("Location: /OursEvent/Frontend/pages/login.html");
exit();
?>
