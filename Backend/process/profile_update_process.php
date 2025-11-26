<?php
/*
========================================================
PROFILE UPDATE PROCESS
File ini menerima POST dari frontend (profile.html)
yang mengirim:
- nama_lengkap
- no_hp
- password_baru (optional)

BACKEND harus melakukan:
1. Ambil id_user dari session
2. Jika password baru KOSONG → update hanya nama & no_hp
3. Jika password baru DIISI → hash dulu, baru update
4. Redirect balik ke profile.php
========================================================
*/

// Backend implement logic UPDATE user
?>
