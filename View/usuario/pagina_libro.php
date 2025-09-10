<?php
session_start();
require_once('../../Model/entity/conexion.php');
$db = new conexion();
$conexion = $db->conectar();
$busqueda = isset($_GET['buscar']) ? $conexion->real_escape_string($_GET['buscar']) : '';
$query = "SELECT * FROM libros 
          WHERE titulo LIKE '%$busqueda%' 
          OR autor LIKE '%$busqueda%' 
          OR editorial LIKE '%$busqueda%'";
$resultado = $conexion->query($query);
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
			<?php while ($row = $resultado->fetch_assoc()): ?>
				<tr>
					<td><?= htmlspecialchars($row['titulo']); ?></td>
					<td><?= htmlspecialchars($row['autor']); ?></td>
					<td><?= htmlspecialchars($row['editorial']); ?></td>
					<td><?= $row['disponibilidad'] ? '✅ Sí' : '❌ No'; ?></td>
					<td>
                        <?php if (!$row['disponibilidad']):?>
                            <a href="../../Controller/peticiones/registrar_reserva.php?id=<?= $row['id_libro']; ?>" class="btn btn-edit">📖 Reservar</a>
                        <?php endif; ?>
                        <?php if ($row['disponibilidad']): ?>
                            <a href="../../Controller/peticiones/registrar_prestamo.php?id=<?= $row['id_libro']; ?>" class="btn btn-delete">📚 Pedir prestado</a>
                        <?php endif; ?>
                        <?php if (!$row['disponibilidad']): ?>
                            <span style="color:red; font-weight:bold;">No disponible</span>
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
