<!-- Prosses login user  -->

<?php

    session_start();

    require_once "../includes/db_connect.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    // user tidak ditemukan, mka akan balik ke login
    if (!$user){
        header("Location: ../public/login.php?error=notfound");
        exit();
    }
    
    // verifikasi password
    if (!password_verify($password, $user['password'])) {
        header("Location: ../public/login.php?error=wrongpassword");
        exit();
    }

    $_SESSION['user_id'] = $user['id_user'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];

    header("Location: ../public/index.php");
?>