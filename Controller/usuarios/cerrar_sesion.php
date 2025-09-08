<?php
session_start();
session_unset();
session_destroy();
header("Location: ../../View/cliente_login.php");
exit();
?>