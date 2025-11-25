<!-- kumpulan fungsi penting untuk query database. -->

<?php
    function getCategories($conn) {
        $sql = "SELECT FROM kategori_event ORDER BY nama_kategori ASC";
        return mysqli_query($conn, $sql);
    }
?>