<?php
session_start();
require_once('../../Model/entity/conexion.php');

$db = new conexion();
$conexion = $db->conectar();
$busqueda = isset($_GET['buscar']) ? $conexion->real_escape_string($_GET['buscar']) : '';
$query = "
    SELECT l.*,
        (SELECT COUNT(*) 
         FROM bd_biblioteca.reservas r 
         WHERE r.id_libro = l.id_libro 
           AND r.activa = 1) AS reservas_activas
    FROM bd_biblioteca.libros l
    WHERE l.titulo LIKE '%$busqueda%' 
       OR l.autor LIKE '%$busqueda%' 
       OR l.editorial LIKE '%$busqueda%'
    ORDER BY l.titulo ASC
";

$resultado = $conexion->query($query);
if (!$resultado) {
    die("Error en la consulta: " . $conexion->error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Consultar Libros</title>
	<link rel="stylesheet" href="../../CSS/tablas/tables.css">
	<link rel="stylesheet" href="../../CSS/tablas/modales.css">
</head>
<body>
<div class="content">
	<h2>📚 Consulta de Libros</h2>
	<form method="GET">
		<input type="text" name="buscar" placeholder="Buscar por título, autor o editorial" value="<?= htmlspecialchars($busqueda) ?>">
		<button type="submit" class="modal-btn">🔍 Buscar</button>
	</form>
</div>

<div class="content">
	<?php if (isset($_GET['error']) && $_GET['error'] == 'max_reservas'): ?>
		<p class="error-msg">⚠️ Solo puedes tener máximo 5 reservas activas.</p>
	<?php elseif (isset($_GET['success']) && $_GET['success'] == 1): ?>
		<p class="success-msg">📖 Reserva realizada con éxito.</p>
	<?php elseif (isset($_GET['success']) && $_GET['success'] == 2): ?>
		<p class="success-msg">📚 Préstamo realizado con éxito.</p>
	<?php endif; ?>
</div>

<div class="table-container">
	<table class="styled-table">
		<thead>
			<tr>
				<th>Título</th>
				<th>Autor</th>
				<th>Editorial</th>
				<th>Disponible</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = $resultado->fetch_assoc()): 
				$disponibilidad = isset($row['disponibilidad']) ? (int)$row['disponibilidad'] : 0;
				$reservas_activas = isset($row['reservas_activas']) ? (int)$row['reservas_activas'] : 0;
			?>
				<tr>
					<td><?= htmlspecialchars($row['titulo']); ?></td>
					<td><?= htmlspecialchars($row['autor']); ?></td>
					<td><?= htmlspecialchars($row['editorial']); ?></td>
					<td><?= $disponibilidad ? '✅ Sí' : '❌ No'; ?></td>
					<td>
						<?php if ($disponibilidad === 1): ?>
							<a href="../../Controller/peticiones/registrar_prestamo.php?id=<?= $row['id_libro']; ?>" class="btn btn-delete">📚 Pedir prestado</a>
						<?php elseif ($disponibilidad === 0 && $reservas_activas === 0): ?>
							<a href="../../Controller/peticiones/registrar_reserva.php?id=<?= $row['id_libro']; ?>" class="btn btn-edit">📖 Reservar</a>
						<?php else: ?>
							<span style="color:red; font-weight:bold;">❌ No disponible</span>
							<?php if ($reservas_activas > 0): ?>
								<small> (Reservas activas: <?= $reservas_activas; ?>)</small>
							<?php endif; ?>
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
