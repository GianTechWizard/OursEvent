<?php
// LOGIN PAGE (UI dibuat frontend)

//////// FRONTEND CATATAN //////////
//
// 1. Frontend buat tampilan form login (HTML + CSS)
//    - input email
//    - input password
//    - button Login
//
// 2. Semua UI ditangani FRONTEND
//    Backend hanya menerima data form melalui POST
//
// 3. Action form harus diarahkan ke:
//    ../process/login_process.php
//////////////////////////////////////
?>

<!-- Contoh struktur form yang HARUS dibuat oleh Frontend -->
 <!-- //ini memanggil logika login -->
<form action="../process/login_process.php" method="POST">

    <!-- Frontend harus membuat input berikut -->
    <!-- email -->
    <input type="email" name="email" placeholder="Masukkan email" required>

    <!-- password -->
    <input type="password" name="password" placeholder="Masukkan password" required>

    <!-- tombol login -->
    <button type="submit">Login</button>

</form>
