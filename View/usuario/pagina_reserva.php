<?php
session_start();
require_once('../../Model/entity/conexion.php');

// ✅ Verificar sesión
if (!isset($_SESSION['correo'])) {
    header("Location: ../registro/cliente_login.php");
    exit();
}

$correo = $_SESSION['correo']; 
$db = new conexion();
$conexion = $db->conectar();

// ✅ Buscar id_usuario por correo
$stmt = $conexion->prepare("SELECT id_usuario FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    die("Usuario no encontrado.");
}

$id_usuario = $usuario['id_usuario'];

// ✅ Consulta de reservas
$query = "
    SELECT r.id_reserva, r.id_libro, r.fecha_reserva, r.activa,
           l.titulo
    FROM reservas r
    INNER JOIN libros l ON r.id_libro = l.id_libro
    WHERE r.id_usuario = ?
    ORDER BY r.fecha_reserva DESC
";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$reservas = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="../../CSS/tablas/tables.css">
    <link rel="stylesheet" href="../../CSS/tablas/modales.css">
</head>
<body>
<div class="content">
    <h2>📌 Mis Reservas</h2>
</div>

<div class="content">
    <?php if (isset($_GET['success']) && $_GET['success'] == 4): ?>
        <p class="success-msg">✅ Reserva cancelada con éxito.</p>
    <?php elseif (isset($_GET['error']) && $_GET['error'] == 3): ?>
        <p class="error-msg">⚠️ No se pudo cancelar la reserva.</p>
    <?php endif; ?>
</div>

<div class="table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th>📖 Libro</th>
                <th>📅 Fecha Reserva</th>
                <th>📌 Activa</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $reservas->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['titulo']); ?></td>
                    <td><?= htmlspecialchars($row['fecha_reserva']); ?></td>
                    <td><?= $row['activa'] ? '✔️ Sí' : '❌ No'; ?></td>
                    <td>
                        <?php if ($row['activa']): ?>
                            <a href="../../Controller/peticiones/cancelar_reseva.php?id_reserva=<?= $row['id_reserva']; ?>&id_libro=<?= $row['id_libro']; ?>" 
                               class="btn btn-edit">❌ Cancelar</a>
                        <?php else: ?>
                            <span style="color: gray; font-weight: bold;">🛑 Inactiva</span>
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
