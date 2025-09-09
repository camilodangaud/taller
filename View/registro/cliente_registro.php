<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method="POST" action="../Controller/usuarios/registrar_usuario.php">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required><br><br>

        <label>Tipo de Usuario:</label><br>
        <select name="tipo_usuario">
            <option value="estudiante">estudiante</option>
            <option value="docente">docente</option>
            <option value="administrador">administrador</option>
        </select><br><br>

        <button type="submit">Registrar</button>
    </form>
    <div>
        <a href="../registro/cliente_login.php">¿Ya tienes una cuenta? Inicia sesión aquí</a>
    </div>
</body>
</html>