<!-- menghubungkan ke database -->

<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "oursevents";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi Gagal". mysqli_connect_error());
}

echo "Koneksi Berhasil"

?>

