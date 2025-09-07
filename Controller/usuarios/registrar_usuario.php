<?php
$baseDir = dirname(dirname(__DIR__));
require_once($baseDir . '/Model/entity/usuario.php');
require_once($baseDir . '/Model/crud/usuario_crud.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $tipo = $_POST['tipo_usuario'];

    $usuario = new usuario($nombre, $correo, $contrasena, $tipo);

    $crud = new usuario_crud();
    if ($crud->crearUsuario($usuario)) {
        $mensaje = "Usuario registrado correctamente ✅";
    } else {
        $mensaje = "Error al registrar usuario ❌";
    }

    header("Location: ../../view/cliente_login.php?mensaje=" . urlencode($mensaje));
    exit;
}
