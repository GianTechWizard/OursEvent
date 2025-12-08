<!--Pengecekkan apakah user sudah login-->

<?php
//    session_start();

// if (!isset($_SESSION['user_id'])) {
//     header("Location: ../pages/login.html");
//     exit();
// }
//   if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

// if (!isset($_SESSION['user_id'])) {

//     // jika diakses lewat AJAX fetch()
//     if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
//         strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {

//         echo json_encode(["error" => "not_logged_in"]);
//         exit();
//     }

//     // jika akses normal di browser
//     header("Location: ../../Frontend/pages/login.html?error=not_logged_in");
//     exit();
// }


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika user belum login
if (!isset($_SESSION['user_id'])) {

    // Jika request datang dari fetch() atau AJAX
    $isAjax =
        (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) ||
        (!empty($_SERVER['CONTENT_TYPE']) &&
         strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false);

    if ($isAjax) {
        http_response_code(401);
        echo json_encode(["error" => "not_logged_in"]);
        exit();
    }

    // Jika bukan AJAX → redirect biasa
    header("Location: ../../Frontend/pages/login.html?error=not_logged_in");
    exit();
}
?>

?>