<?php
session_start();
require_once('../../Model/entity/conexion.php');
require_once('../../Model/crud/reserva_crud.php');

if (!isset($_SESSION['correo'])) {
    header("Location: ../../View/registro/cliente_login.php");
    exit();
}

$correo = $_SESSION['correo'];

$db = new conexion();
$conexion = $db->conectar();

$sql = "SELECT id_usuario FROM usuarios WHERE correo = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    header("Location: ../../View/registro/cliente_login.php?error=usuario_no_encontrado");
    exit();
}

$id_usuario = $usuario['id_usuario'];
$id_libro = $_GET['id'];
$fecha = date("Y-m-d");

// Crear la reserva
$reserva = new reserva($id_usuario, $id_libro, $fecha);
$crud = new reserva_crud();

if ($crud->insertar_reserva($reserva)) {
    header("Location: ../../View/usuario/pagina_libro.php?success=1");
} else {
    header("Location: ../../View/usuario/pagina_libro.php?error=1");
}
?>
