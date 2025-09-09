<?php
require_once __DIR__ . '/../../Model/Entity/libro.php';
require_once __DIR__ . '/../../Model/Crud/libro_crud.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_libro'] ?? 0;
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $editorial = $_POST['editorial'] ?? '';
    $disponibilidad = $_POST['disponibilidad'] ?? 1;

    $libro = new libro($titulo, $autor, $editorial, $disponibilidad);
    $crud = new libro_crud();

    if ($crud->actualizarLibro($id, $libro)) {
        header("Location: ../../View/admin/pagina_libro.php?success=2");
    } else {
        header("Location: ../../View/admin/pagina_libro.php?error=2");
    }
    exit();
}
?>
