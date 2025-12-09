<!-- kumpulan fungsi penting untuk query database (mysqli) -->

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
        $sql = "SELECT * FROM events WHERE id_event = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) { return false; }
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        return $res;
    }

    function getUserRegisteredEvents($conn, $userId) {
        $query = "SELECT e.*
              FROM registrations r
              JOIN events e ON r.event_id = e.id
              WHERE r.user_id = $userId";

        return mysqli_query($conn, $query);
    }

?>