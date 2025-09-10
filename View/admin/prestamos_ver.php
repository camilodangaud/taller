<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'administrador') {
    header("Location: ../registro/cliente_login.php"); 
    exit();
}

require_once('../../Model/entity/conexion.php');
$db = new conexion();
$conexion = $db->conectar();

$query = "SELECT id_prestamo, id_usuario, id_libro, fecha_prestamo, fecha_devolucion, devuelto FROM prestamos";
$resultado = $conexion->query($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Préstamos</title>
    <link rel="stylesheet" href="../../CSS/tablas/tables.css">
</head>
<body>
    <h2>📚 Préstamos</h2>
    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Libro</th>
                    <th>Fecha Préstamo</th>
                    <th>Fecha Devolución</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id_prestamo'] ?></td>
                        <td><?= $row['id_usuario'] ?></td>
                        <td><?= $row['id_libro'] ?></td>
                        <td><?= $row['fecha_prestamo'] ?></td>
                        <td><?= $row['fecha_devolucion'] ?></td>
                        <td><?= $row['devuelto'] ?></td>
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
