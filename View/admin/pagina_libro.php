<?php
require_once('../../Model/entity/conexion.php');
$db = new conexion();
$conexion = $db->conectar();

$query = "SELECT * FROM libros";
$resultado = $conexion->query($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Gestor de Libros</title>
	<link rel="stylesheet" href="../../CSS/tablas/tables.css">
	<link rel="stylesheet" href="../../CSS/tablas/modales.css">
    <link rel="stylesheet" href="../../CSS/tablas/registro.css">
</head>
<body>
<div id="formModal" class="modal hidden">
	<div class="modal-content">
		<span class="close" onclick="hideModal('formModal')">&times;</span>
		<h2 id="modalTitle">Registrar Libro</h2>
		<form id="bookForm" method="POST" action="../../Controller/administrador/libro_registrar.php">
			<input type="hidden" name="id_libro" id="id_libro">

			<label>Título:</label>
			<input type="text" name="titulo" id="titulo" required>

			<label>Autor:</label>
			<input type="text" name="autor" id="autor" required>

			<label>Editorial:</label>
			<input type="text" name="editorial" id="editorial">

			<input type="hidden" name="disponibilidad" id="disponibilidad" value="1">

			<button type="submit" class="modal-btn" id="submitBtn">Registrar Libro</button>
		</form>
	</div>
</div>

<div class="content">
	<h2>Gestor de Libros</h2>
	<button onclick="nuevolibro()" class="modal-btn">+ Registrar Libro</button>
</div>

<div class="content">
	<?php if (isset($_GET['success'])): ?>
		<?php if ($_GET['success'] == 1): ?>
			<p class="success-msg">✅ Libro registrado correctamente.</p>
		<?php elseif ($_GET['success'] == 2): ?>
			<p class="success-msg">✏️ Libro actualizado correctamente.</p>
		<?php elseif ($_GET['success'] == 3): ?>
			<p class="success-msg">🗑️ Libro eliminado correctamente.</p>
		<?php endif; ?>
	<?php endif; ?>
</div>

<div class="table-container">
	<table class="styled-table">
		<thead>
			<tr>
				<th>Título</th>
				<th>Autor</th>
				<th>Editorial</th>
				<th>Disponibilidad</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = $resultado->fetch_assoc()): ?>
				<tr>
					<td><?= htmlspecialchars($row['titulo']); ?></td>
					<td><?= htmlspecialchars($row['autor']); ?></td>
					<td><?= htmlspecialchars($row['editorial']); ?></td>
					<td><?= $row['disponibilidad'] ? 'Disponible' : 'Prestado'; ?></td>
					<td>
						<a href="javascript:void(0)" 
						   onclick='editarLibro(<?= json_encode($row); ?>)' 
						   class="btn btn-edit">✏️ Editar</a>
						<a href="../../Controller/administrador/libro_eliminar.php?id=<?= $row['id_libro']; ?>" 
						   onclick="return confirm('¿Eliminar libro?');"
						   class="btn btn-delete">🗑️ Eliminar</a>
					</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>

    <div>
        <a href="../panel/panel_principal_administrador.php">regresar</a>
    </div>

<script src="../../JS/tablas/form_handler.js"></script> 
</body>
</html>
