<?php
session_start();
session_unset();
session_destroy();

header("Location: /OursEvent/Frontend/pages/login.html");
exit();
?>
