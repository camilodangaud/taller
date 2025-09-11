<?php
session_start();
require_once('../../Model/entity/conexion.php');
require_once('../../Model/crud/prestamo_crud.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: ../../View/login.php");
    exit();
}

if (!isset($_GET['id_prestamo']) || !isset($_GET['id_libro'])) {
    die("Datos incompletos.");
}

$id_prestamo = (int) $_GET['id_prestamo'];
$id_libro = (int) $_GET['id_libro'];

$crud = new prestamo_crud();
if ($crud->devolver_prestamo($id_prestamo, $id_libro)) {
    header("Location: ../../View/usuario/pagina_prestamos.php?success=3");
    exit();
} else {
    header("Location: ../../View/usuario/pagina_prestamos.php?error=2");
    exit();
}
?>
