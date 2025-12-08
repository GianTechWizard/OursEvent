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

   
session_start();

require_once "../includes/db_connection.php";

// cek method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../Frontend/pages/login.html?error=invalid_method");
    exit();
}

// ambil input dengan pengecekan
$email = "";
if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
}

$password = "";
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}

if ($email === "" || $password === "") {
    header("Location: ../../Frontend/pages/login.html?error=empty");
    exit();
}

// prepared statement untuk ambil user berdasarkan email
$sql = "SELECT id_user, username, email, password, role FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
if ($stmt === false) {
    header("Location: ../../Frontend/pages/login.html?error=server");
    exit();
}
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$user) {
    header("Location: ../../Frontend/pages/login.html?error=notfound");
    exit();
}

// verifikasi password (kolom password di DB menyimpan hash)
if (!password_verify($password, $user['password'])) {
    header("Location: ../../Frontend/pages/login.html?error=wrongpassword");
    exit();
}

// set session (gunakan nama konsisten)
$_SESSION['user_id']  = $user['id_user'];
$_SESSION['username'] = $user['username'];
$_SESSION['email']    = $user['email'];
$_SESSION['role']     = $user['role'];

header("Location: ../../Frontend/pages/index.html");
exit();
?>

