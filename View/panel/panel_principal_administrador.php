<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'administrador') {
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
    <title>Panel Principal - Administrador</title>
    <link rel="stylesheet" href="../../CSS/usuario/usuario_estilos.css">
</head>
<body>

<header>
    <h1>📚 Biblioteca Online - Panel Administrador</h1>
    <div class="usuario">
        <span>👤 <?php echo htmlspecialchars($usuario); ?> (<?php echo ucfirst($tipo_usuario); ?>)</span>
        <button id="abrirModalCerrar" type="button">Cerrar sesión</button>
    </div>
</header>

<main>
    <h2>Bienvenido, <?php echo htmlspecialchars($usuario); ?> (Administrador)</h2>
    <p>Selecciona una acción:</p>

    <div class="acciones">
        <button id="abrirModalGestionarLibros">📑 Gestionar Libros</button>
        <button id="abrirModalUsuarios">👥 Ver Usuarios</button>
        <button id="abrirModalReservas">📖 Ver Reservas</button>
        <button id="abrirModalPrestamos">📚 Ver Préstamos</button>
    </div>
</main>

<div id="modalGestionarLibros" class="modal">
  <div class="modal-contenido">
    <span class="cerrar">&times;</span>
    <p>¿Quieres ir al panel de gestión de libros?</p>
    <button onclick="location.href='../admin/pagina_libro.php'">Sí</button>
    <button class="cancelar">Cancelar</button>
  </div>
</div>

<div id="modalUsuarios" class="modal">
  <div class="modal-contenido">
    <span class="cerrar">&times;</span>
    <p>¿Quieres ver los usuarios registrados?</p>
    <button onclick="location.href='../admin/usuarios_ver.php'">👥 Ver Usuarios</button>
    <button class="cancelar">Cancelar</button>
  </div>
</div>

<div id="modalReservas" class="modal">
  <div class="modal-contenido">
    <span class="cerrar">&times;</span>
    <p>¿Quieres ver todas las reservas?</p>
    <button onclick="location.href='../admin/reservas_ver.php'">📖 Ver Reservas</button>
    <button class="cancelar">Cancelar</button>
  </div>
</div>

<div id="modalPrestamos" class="modal">
  <div class="modal-contenido">
    <span class="cerrar">&times;</span>
    <p>¿Quieres ver todos los préstamos?</p>
    <button onclick="location.href='../admin/prestamos_ver.php'">📚 Ver Préstamos</button>
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

<script src="../../JS/ventanas/administrador.js"></script>
</body>
</html>
