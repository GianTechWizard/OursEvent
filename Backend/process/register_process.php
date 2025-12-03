<?php

   require_once "../includes/db_connection.php";

   $username = $_POST ['Nama Lengkap'];
   $email = $_POST ['email'];
   $no_hp = $_POST ['no_hp'];
   $institusi = $_POST ['institusi'];
   $password = $_POST ['password'];
   $confirm_password = $_POST ['confirm_password'];

   if (empty ($nama_lengkap) || empty ($email) || empty ($no_hp) || empty($password) || empty ($institusi)) {
      header("Location: ../public/register.php?error=empty");
   }

   if ($password !== $confirm_password) {
      header("Location: ../public/register.php?error=password_mismatch");
   }

   $check = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email'");
   if (mysqli_num_rows($check) > 0) {
      header("Location: ../public/register.php?error=email_exists");
   }

   $hashed = password_hash($password, PASSWORD_DEFAULT);

   $sql = "INSERT INTO users (username, email, password, no_hp, institusi, role)
        VALUES ('$username', '$email', '$hashed_password', '$no_hp', '$institusi', 'users')";
   
   mysqli_query($conn, $sql);

   header("Location: ../public/login.php?success=registered"); 
   exit();
?>
