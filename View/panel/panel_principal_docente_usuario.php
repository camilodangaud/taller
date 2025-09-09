<?php
session_start();
if (!isset($_SESSION['usuario'])|| $_SESSION['tipo'] !== 'docente' && $_SESSION['tipo'] !== 'estudiante'  ) {
    header("Location: ../registro/cliente_login.php"); 
    exit();
}
$usuario = $_SESSION['usuario']; 
$tipo_usuario = $_SESSION['tipo'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Principal - Usuario</title>
    <link rel="stylesheet" href="../../CSS/usuario/usuario_estilos.css">
</head>
<body>

<header>
    <h1>📚 Biblioteca Online</h1>
    <div class="usuario">
        <span>👤 <?php echo htmlspecialchars($usuario); ?></span>
        <button id="abrirModalCerrar" type="button">Cerrar sesión</button>
    </div>
</header>

<main>
    <h2>Bienvenido, <?php echo htmlspecialchars($usuario); ?> (<?php echo ucfirst($tipo_usuario); ?>)</h2>
    <p>Selecciona una acción:</p>

    <div class="acciones">
        <button id="abrirModalBuscar">🔎 Buscar Libros</button>
        <button id="abrirModalReservas">📖 Mis Reservas</button>
        <button id="abrirModalPrestamos">📚 Historial de Préstamos</button>
    </div>
</main>

<div id="modalBuscar" class="modal">
  <div class="modal-contenido">
    <span class="cerrar">&times;</span>
    <p>¿Quieres ir a la sección de búsqueda de libros?</p>
    <button onclick="location.href='../Model/crud/libro.php'">Sí</button>
    <button class="cancelar">Cancelar</button>
  </div>
</div>

<div id="modalReservas" class="modal">
  <div class="modal-contenido">
    <span class="cerrar">&times;</span>
    <p>¿Quieres ver tus reservas?</p>
    <button onclick="location.href='../Model/crud/reserva.php'">Sí</button>
    <button class="cancelar">Cancelar</button>
  </div>
</div>

<div id="modalPrestamos" class="modal">
  <div class="modal-contenido">
    <span class="cerrar">&times;</span>
    <p>¿Quieres ver tu historial de préstamos?</p>
    <button onclick="location.href='../Model/crud/prestamo.php'">Sí</button>
    <button class="cancelar">Cancelar</button>
  </div>
</div>
<div id="modalCerrar" class="modal">
  <div class="modal-contenido">
    <span class="cerrar">&times;</span>
    <p>¿Estás seguro que quieres cerrar sesión?</p>
    <button id="confirmarCerrar">Sí, salir</button>
    <button id="cancelarCerrar">Cancelar</button>
  </div>
</div>
<script src="../../JS/ventanas/acciones.js"></script>
</body>
</html>
