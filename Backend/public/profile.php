<?php
// ====================================================================
// Bagian backend
// --------------------------------------------------------------------
// Fungsi file ini:
// 1. Mengecek apakah user sudah login (session_check.php)
// 2. Mengambil data user dari database
// 3. Mengirimkan data ini ke FRONTEND (UI form profile)
//
// CATATAN:
// Frontend akan membuat FORM HTML di bagian BODY file ini.
// Backend TIDAK membuat tampilan, hanya menyediakan data.
//
// UI akan mengirim update ke:
//   ../process/profile_update_process.php
// ====================================================================


// Menghubungkan ke database (ISI SINI - MARCEL)

// Memanggil fungsi (ISI SINI - MARCEL)

// Mengambil ID user dari session (ISI SINI - MARCEL)

// Query data user (ISI SINI - MARCEL)










// --------------------------------------------------------------
// Bagian FRONTEND
// Buat UI form profil menggunakan HTML, contoh:
//
// <form action="../process/profile_update_process.php" method="POST">
//     <input type="text" name="nama" value="<?= $user['nama_lengkap'] ? >">
//     <input type="text" name="no_hp" value="<?= $user['no_hp'] ? >">
//     <input type="password" name="password">
//     <button type="submit">Update</button>
// </form>
//
// Backend tidak membuat UI.
// Backend hanya menyediakan $user untuk ditampilkan.
// --------------------------------------------------------------
?>
