<!-- Prosses login user  -->

<?php

    // session_start();

    // require_once "../includes/db_connection.php";

    // if (!isset($_POST['email']) || !isset($_POST['password'])) {
    //     header("Location: ../public/login.html?error=invalid");
    // exit();
    // }


    // $email = $_POST['email'];
    // $password = $_POST['password'];

    // $sql = "SELECT * FROM users WHERE email = '$email'";
    // $result = mysqli_query($conn, $sql);
    // $user = mysqli_fetch_assoc($result);

    // if (!$user){
    //     header("Location: ../public/login.php?error=notfound");
    //     exit();
    // }
    
    // if (!password_verify($password, $user['password'])) {
    //     header("Location: ../public/login.php?error=wrongpassword");
    //     exit();
    // }

    // $_SESSION['user_id'] = $user['id_user'];
    // $_SESSION['username'] = $user['username'];
    // $_SESSION['email'] = $user['email'];
    // $_SESSION['role'] = $user['role'];

    // header("Location: ../public/index.php");
    // exit();

   
// session_start();

// require_once "../includes/db_connection.php";

// // cek method POST
// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     header("Location: ../../Frontend/pages/login.html?error=invalid_method");
//     exit();
// }

// // ambil input dengan pengecekan
// $email = "";
// if (isset($_POST['email'])) {
//     $email = trim($_POST['email']);
// }

// $password = "";
// if (isset($_POST['password'])) {
//     $password = $_POST['password'];
// }

// if ($email === "" || $password === "") {
//     header("Location: ../../Frontend/pages/login.html?error=empty");
//     exit();
// }

// // prepared statement untuk ambil user berdasarkan email
// $sql = "SELECT id_user, username, email, password, role FROM users WHERE email = ?";
// $stmt = mysqli_prepare($conn, $sql);
// if ($stmt === false) {
//     header("Location: ../../Frontend/pages/login.html?error=server");
//     exit();
// }
// mysqli_stmt_bind_param($stmt, "s", $email);
// mysqli_stmt_execute($stmt);
// $result = mysqli_stmt_get_result($stmt);
// $user = mysqli_fetch_assoc($result);
// mysqli_stmt_close($stmt);

// if (!$user) {
//     header("Location: ../../Frontend/pages/login.html?error=notfound");
//     exit();
// }

// // verifikasi password (kolom password di DB menyimpan hash)
// if (!password_verify($password, $user['password'])) {
//     header("Location: ../../Frontend/pages/login.html?error=wrongpassword");
//     exit();
// }

// // set session (gunakan nama konsisten)
// $_SESSION['user_id']  = $user['id_user'];
// $_SESSION['username'] = $user['username'];
// $_SESSION['email']    = $user['email'];
// $_SESSION['role']     = $user['role'];

// header("Location: ../../Frontend/pages/index.html");
// exit();


// ===============================
// LOGIN PROCESS (FINAL VERSION)
// ===============================

// session_start();

// // Hapus session lama jika ada (mencegah session zombie)
// session_unset();
// session_destroy();
// session_start();

// require_once "../includes/db_connection.php";

// // cek method POST
// if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//     header("Location: ../../Frontend/pages/login.html?error=invalid_method");
//     exit();
// }

// // ambil input dengan validasi
// $email = isset($_POST['email']) ? trim($_POST['email']) : "";
// $password = isset($_POST['password']) ? $_POST['password'] : "";

// if ($email === "" || $password === "") {
//     header("Location: ../../Frontend/pages/login.html?error=empty");
//     exit();
// }

// // ambil data user pakai prepared statement
// $sql = "SELECT id_user, username, email, password, role 
//         FROM users 
//         WHERE email = ? 
//         LIMIT 1";

// $stmt = mysqli_prepare($conn, $sql);
// if ($stmt === false) {
//     header("Location: ../../Frontend/pages/login.html?error=server");
//     exit();
// }

// mysqli_stmt_bind_param($stmt, "s", $email);
// mysqli_stmt_execute($stmt);
// $result = mysqli_stmt_get_result($stmt);
// $user = mysqli_fetch_assoc($result);
// mysqli_stmt_close($stmt);

// // ------------------------------
// // CEK USER ADA / TIDAK
// // ------------------------------
// if (!$user || !isset($user['id_user'])) {
//     // user sudah terhapus / tidak ditemukan
//     header("Location: ../../Frontend/pages/login.html?error=notfound");
//     exit();
// }

// // ------------------------------
// // CEK PASSWORD
// // ------------------------------
// if (!password_verify($password, $user['password'])) {
//     header("Location: ../../Frontend/pages/login.html?error=wrongpassword");
//     exit();
// }

// // ------------------------------
// // SET SESSION BARU
// // ------------------------------
// $_SESSION['user_id']  = $user['id_user'];
// $_SESSION['username'] = $user['username'];
// $_SESSION['email']    = $user['email'];
// $_SESSION['role']     = $user['role'];

// // ------------------------------
// // LOGIN BERHASIL
// // ------------------------------
// header("Location: ../../Frontend/pages/index.html");
// exit();


// ===============================
// LOGIN PROCESS (FINAL FIX)
// ===============================

// Hapus session lama sepenuhnya
session_start();
session_unset();
session_destroy();

// Hapus cookie session dari browser
if (ini_get("session.use_cookies")) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $p["path"], $p["domain"], $p["secure"], $p["httponly"]
    );
}

// Mulai session BARU YANG BENAR-BENAR KOSONG
session_start();

require_once "../includes/db_connection.php";

// Harus POST
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

// Ambil user by email
$sql = "SELECT id_user, username, email, password, role FROM users WHERE email = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// ------------------------------
// CEK: USER TIDAK ADA DI DATABASE
// ------------------------------
if (!$user) {
    // TIDAK BOLEH LOGIN
    session_unset();
    session_destroy();
    header("Location: ../../Frontend/pages/login.html?error=notfound");
    exit();
}

// ------------------------------
// CEK PASSWORD
// ------------------------------
if (!password_verify($password, $user['password'])) {
    session_unset();
    session_destroy();
    header("Location: ../../Frontend/pages/login.html?error=wrongpassword");
    exit();
}

// ------------------------------
// SET SESSION BARU
// ------------------------------
$_SESSION["user_id"] = $user["id_user"];
$_SESSION["username"] = $user["username"];
$_SESSION["email"] = $user["email"];
$_SESSION["role"] = $user["role"];

// ------------------------------
// BERHASIL LOGIN
// ------------------------------
header("Location: ../../Frontend/pages/index.html");
exit();
?>





