<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'administrador') {
    header("Location: ../registro/cliente_login.php"); 
    exit();
}

require_once('../../Model/entity/conexion.php');
$db = new conexion();
$conexion = $db->conectar();

$query = "SELECT id_usuario, nombre, correo, tipo_usuario FROM usuarios";
$resultado = $conexion->query($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Registrados</title>
    <link rel="stylesheet" href="../../CSS/tablas/tables.css">
</head>
<body>
    <h2>👥 Lista de Usuarios</h2>
    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id_usuario'] ?></td>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><?= htmlspecialchars($row['correo']) ?></td>
                        <td><?= htmlspecialchars($row['tipo_usuario']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <div>
        <a href="../panel/panel_principal_administrador.php">⬅️ Regresar</a>
    </div>
</body>
</html>
