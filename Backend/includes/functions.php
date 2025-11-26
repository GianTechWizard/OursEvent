<!-- kumpulan fungsi penting untuk query database. -->

<?php
    function getCategories($conn) {
        $sql = "SELECT FROM kategori_event ORDER BY nama_kategori ASC";
        return mysqli_query($conn, $sql);
    }

    function getEvents ($conn) {
        $sql = "SELECT events. *, kategori . nama_kategori FROM events e  
        JOIN kategori _event kategori ON events.id_kategori = kategori.id_kategori 
        ORDER BY events.tanggal ESC";
        return mysqli_query($conn, $sql);
    }

    function getEventById ($conn, $id) {
        $id = mysqli_real_escape_string($conn, $id);
        $sql = "SELECT * FROM events WHERE id_event = '$id's";
        return mysqli_query($conn, $sql);
    }
?>