<?php
require_once __DIR__ . '/../../Model/Crud/libro_crud.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $crud = new libro_crud();

    if ($crud->eliminarLibro($id)) {
        header("Location: ../../View/admin/pagina_libro.php?success=3");
    } else {
        header("Location: ../../View/admin/pagina_libro.php?error=3");
    }
    exit();
}
?>

