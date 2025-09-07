<?php
session_start();
$mensaje = isset($_SESSION['error']) ? $_SESSION['error'] : "";
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="../Controller/usuarios/obtener_usuario.php">
        <label>Correo:</label><br>
        <input type="email" name="correo" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required><br><br>

        <button type="submit">Ingresar</button>
    </form>

    <div>
        <a href="../View/cliente_registro.php">¿No tienes una cuenta? Regístrate aquí</a>
    </div>

</body>
</html>
