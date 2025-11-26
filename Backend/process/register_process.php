<?php
/*
========================================================
REGISTER PROCESS
File ini menerima POST dari register.html

Data yang dikirim:
- nama_lengkap
- email
- no_hp
- password

BACKEND MUST DO:
1. Validasi input tidak kosong
2. Cek apakah email sudah digunakan
3. Hash password → password_hash($password, PASSWORD_DEFAULT)
4. Insert ke tabel users:
   - role default = 'user'
5. Redirect ke login.php setelah sukses
========================================================
*/

// Backend implement logic registrasi user
//jangan lupa juga enskiripsi password
?>
