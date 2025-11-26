<?php

require_once "../includes/db_connect.php";
require_once "../includes/session_check.php"; 

// pengecekkan session_check untuk memastikan user harus login dulu (ISI CODE SINI- MARCEL)


// proses Pengambilan semua event yang sudah didaftarkan oleh user (ISI CODE SINI- MARCEL)



/*
==============================================================
INI BAGIAN FRONTEND 
--------------------------------------------------------------
Frontend akan membuat UI RIWAYAT PENDAFTARAN USER.

Data yang ada di $data:
- judul_event
- tanggal event
- lokasi event
- jumlah_tiket
- total_biaya
- status (Pending / Paid / Cancel)

Frontend harus looping:

while ($row = mysqli_fetch_assoc($data)) {
    tampilkan:
    - judul_event
    - tanggal
    - lokasi
    - jumlah_tiket
    - total_biaya
    - status
}

Backend hanya menyiapkan data.
==============================================================
*/
?>
