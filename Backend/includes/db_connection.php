<!-- menghubungkan ke database -->

<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "oursevents";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection Failed". mysqli_connect_error());
}

echo "Connection Successful";


?>

