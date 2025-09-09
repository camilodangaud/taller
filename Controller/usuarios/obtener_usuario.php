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
        $_SESSION['usuario']    = $usuario->getNombre();
        $_SESSION['correo']     = $usuario->getCorreo();
        $_SESSION['contrasena'] = $usuario->getContraseña();
        $_SESSION['tipo']       = $usuario->getTipo();

        if ($usuario->getTipo() === 'administrador') {
            header("Location: ../../View/panel/panel_principal_administrador.php");
        } elseif ($usuario->getTipo() === 'docente' || $usuario->getTipo() === 'estudiante') {
            header("Location: ../../View/panel/panel_principal_docente_estudiante.php");
        } else {
            $_SESSION['error'] = "⚠️ Tipo de usuario no válido";
            header("Location: ../../View/registro/cliente_login.php");
        }
        exit;
    } else {
        $_SESSION['error'] = "❌ Correo o contraseña incorrectos";
        header("Location: ../../View/registro/cliente_login.php");
        exit;
    }
}
?>
