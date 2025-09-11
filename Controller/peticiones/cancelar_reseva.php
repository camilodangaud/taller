<?php
session_start();
require_once('../../Model/crud/reserva_crud.php');

if (!isset($_SESSION['correo'])) {
    header("Location: ../../View/registro/cliente_login.php");
    exit();
}

if (isset($_GET['id_reserva'])) {
    $id_reserva = intval($_GET['id_reserva']);

    require_once('../../Model/entity/conexion.php');
    $db = new conexion();
    $conexion = $db->conectar();

    $stmt = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $_SESSION['correo']);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    if ($usuario) {
        $id_usuario = $usuario['id_usuario'];

        $crud = new reserva_crud();
        if ($crud->cancelar_reserva($id_reserva, $id_usuario)) {
            header("Location: ../../View/usuario/pagina_reserva.php?success=4");
            exit();
        } else {
            header("Location: ../../View/usuario/pagina_reserva.php?error=3");
            exit();
        }
    } else {
        die("Usuario no encontrado.");
    }
} else {
    header("Location: ../../View/panel/panel_reservas.php?error=3");
    exit();
}
?>
