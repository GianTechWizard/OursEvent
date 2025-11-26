<?php
// ====================================================================
// BACKEND FILE: register.php
// --------------------------------------------------------------------
// File ini TIDAK memproses apa pun.
// Fungsinya hanya menjadi WADAH untuk FRONTEND menaruh UI register.
//
// Catatan penting:
// - UI dibuat oleh FRONTEND di bagian HTML file ini
// - Ketika user submit, data dikirim ke:
//       ../process/register_process.php
//
// Contoh UI frontend (yang akan kalian tulis):
//
// <form action="../process/register_process.php" method="POST">
//      <input type="text" name="nama_lengkap">
//      <input type="email" name="email">
//      <input type="password" name="password">
//      <input type="text" name="no_hp">
//      <button type="submit">Register</button>
// </form>
//
// Backend *hanya* menerima POST di register_process.php.
// ====================================================================
?>
