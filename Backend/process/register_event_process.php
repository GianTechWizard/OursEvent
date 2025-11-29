<?php
/*
========================================================
REGISTER EVENT PROCESS
Dikirim dari event_detail.html via POST

Data yang dikirim:
- id_event
- jumlah_tiket

BACKEND harus:
1. Ambil id_user dari session
2. Ambil harga event dari database (SELECT harga FROM events)
3. Hitung total_biaya = harga * jumlah_tiket
4. Insert ke tabel pendaftaran_event:
   - id_user
   - id_event
   - jumlah_tiket
   - total_biaya
   - status = 'Pending'
5. Redirect ke my_registrations.php
========================================================
*/

//  Backend implement INSERT pendaftaran event
?>


