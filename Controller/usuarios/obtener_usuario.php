<?php
session_start();

$baseDir = dirname(dirname(__DIR__));
require_once($baseDir . '/Model/entity/usuario.php');
require_once($baseDir . '/Model/crud/usuario_crud.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $crud = new usuario_crud();
    $usuario = $crud->loginUsuario($correo, $contrasena);

    if ($usuario !== null) {
        $_SESSION['usuario'] = $usuario->getNombre();
        $_SESSION['correo'] = $usuario->getCorreo();
        $_SESSION['contrasena'] = $usuario->getContraseña();
        $_SESSION['tipo']   = $usuario->getTipo();

        header("Location: ../../View/panel_principal.php"); 
        exit;
    } else {
        $_SESSION['error'] = "❌ Correo o contraseña incorrectos";
        header("Location: ../../View/cliente_login.php");
        exit;
    }
}
?>
