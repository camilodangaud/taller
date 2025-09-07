<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method="POST" action="">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

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

    <p><?php echo $mensaje; ?></p>
</body>
</html>