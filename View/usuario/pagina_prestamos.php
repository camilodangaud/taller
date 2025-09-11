<?php
session_start();
require_once('../../Model/entity/conexion.php');

// ✅ Verificar que haya sesión activa
if (!isset($_SESSION['correo'])) {
    header("Location: ../registro/cliente_login.php");
    exit();
}

$correo = $_SESSION['correo']; // usamos el correo real de la sesión
$db = new conexion();
$conexion = $db->conectar();

// ✅ Buscar el id_usuario por correo
$stmt = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    die("Usuario no encontrado.");
}

$id_usuario = $usuario['id_usuario'];

// ✅ Traer préstamos de ese usuario
$query = "
    SELECT p.id_prestamo, p.id_libro, p.fecha_prestamo, p.fecha_devolucion, p.devuelto, 
           l.titulo
    FROM prestamos p
    INNER JOIN libros l ON p.id_libro = l.id_libro
    WHERE p.id_usuario = ?
    ORDER BY p.fecha_prestamo DESC
";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$prestamos = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Préstamos</title>
    <link rel="stylesheet" href="../../CSS/tablas/tables.css">
    <link rel="stylesheet" href="../../CSS/tablas/modales.css">
</head>
<body>
<div class="content">
    <h2>📚 Mis Préstamos</h2>
</div>

<div class="content">
    <?php if (isset($_GET['success']) && $_GET['success'] == 3): ?>
        <p class="success-msg">✅ Préstamo devuelto con éxito.</p>
    <?php elseif (isset($_GET['error']) && $_GET['error'] == 2): ?>
        <p class="error-msg">⚠️ No se pudo devolver el préstamo.</p>
    <?php endif; ?>
</div>

<div class="table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th>📖 Libro</th>
                <th>📅 Fecha Préstamo</th>
                <th>📅 Fecha Devolución</th>
                <th>✅ Devuelto</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $prestamos->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['titulo']); ?></td>
                    <td><?= htmlspecialchars($row['fecha_prestamo']); ?></td>
                    <td><?= $row['fecha_devolucion'] ? htmlspecialchars($row['fecha_devolucion']) : '---'; ?></td>
                    <td><?= $row['devuelto'] ? '✔️ Sí' : '❌ No'; ?></td>
                    <td>
                        <?php if (!$row['devuelto']): ?>
                            <a href="../../Controller/peticiones/devolucion_prestamo.php?id_prestamo=<?= $row['id_prestamo']; ?>&id_libro=<?= $row['id_libro']; ?>" 
                               class="btn btn-edit">↩️ Devolver</a>
                        <?php else: ?>
                            <span style="color: green; font-weight: bold;">✅ Devuelto</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<div>
    <a href="../panel/panel_principal_docente_estudiante.php">⬅️ Regresar</a>
</div>
</body>
</html>
