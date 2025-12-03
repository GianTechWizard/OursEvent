<!-- Prosses login user  -->

<?php

    session_start();

    require_once "../includes/db_connection.php";

    if (isset($_POST['email']) || !isset($_POST['password'])) {
        header("Location: ../public/login.html?error=invalid");
        exit();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if (!$user){
        header("Location: ../public/login.php?error=notfound");
        exit();
    }
    
    if (!password_verify($password, $user['password'])) {
        header("Location: ../public/login.php?error=wrongpassword");
        exit();
    }

    $_SESSION['user_id'] = $user['id_user'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    header("Location: ../public/index.php");
    exit();
?>