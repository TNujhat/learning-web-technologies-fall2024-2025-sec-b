<?php
session_start();
session_destroy();
header("location: ../View/admin_login.php");
exit();
?>
