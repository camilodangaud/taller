<?php
session_start();
session_unset();
session_destroy();
header("Location: ../../View/registro/cliente_login.php");
exit();
?>