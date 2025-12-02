<?php

require_once "../includes/db_connect.php";
require_once "../includes/session_check.php"; 

require_once "../includes/functions.php";

$result = getEvents($mysqli);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "Ada " . mysqli_num_rows($result) . " event tersimpan dalam database ";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<br>Event: " . $row['nama_event'] . " pada " . $row['tanggal'] . " jam " . $row['jam'] . " (Kategori: " . $row['nama_kategori'] . ")";
        }
    } else {
        echo "Belum ada data event.";
    }
} else {
    echo "Error dalam query: " . mysqli_error($mysqli);
}


?>
