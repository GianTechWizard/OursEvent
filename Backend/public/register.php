<?php
// ====================================================================
// FILE: register.php  (BACKEND)
// --------------------------------------------------------------------
// File ini *tidak memproses data*.
// Fungsinya hanya sebagai HALAMAN BACKEND yang memuat UI register.
//
// UI asli dibuat frontend di:
//     /FRONTEND/pages/register.html
//
// Jadi register.php hanya meng-include file HTML tersebut,
// supaya bisa diakses melalui browser menggunakan:
//     localhost/oursevents/BACKEND/public/register.php
//
// Ketika form register di-submit, data akan dikirim ke:
//     ../process/register_process.php
//
// ====================================================================
?>

<?php include "../../Frontend/pages/register.html"; ?>