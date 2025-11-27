<!-- kumpulan fungsi penting untuk query database. -->

<?php
    function getCategories($conn) {
        $sql = "SELECT * FROM kategori_event ORDER BY nama_kategori ASC";
        return mysqli_query($conn, $sql);
    }

    function getEvents ($conn) {
        $sql = "SELECT e.*, k.nama_kategori FROM events e  
        JOIN kategori_event k ON e.id_kategori = k.id_kategori 
        ORDER BY e.tanggal ASC";
        return mysqli_query($conn, $sql);
    }

    function getEventById ($conn, $id) {
        $id = mysqli_real_escape_string($conn, $id);
        $sql = "SELECT * FROM events WHERE id_event = '$id'";
        return mysqli_query($conn, $sql);
    }
?>