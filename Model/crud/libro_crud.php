<?php
require_once __DIR__ . '/../Entity/libro.php';
require_once __DIR__ . '/../Entity/conexion.php';

class libro_crud {
    private $conexion;

    public function __construct() {
        $this->conexion = (new conexion())->conectar();
    }
    public function crearLibro(libro $libro) {
        $sql = "INSERT INTO libros (titulo, autor, editorial, disponibilidad) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssi", 
            $libro->getTitulo(),
            $libro->getAutor(),
            $libro->getEditorial(),
            $libro->getDisponibilidad()
        );
        return $stmt->execute();
    }
    public function actualizarLibro($id, libro $libro) {
        $sql = "UPDATE libros SET titulo = ?, autor = ?, editorial = ?, disponibilidad = ? WHERE id_libro = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssii", 
            $libro->getTitulo(),
            $libro->getAutor(),
            $libro->getEditorial(),
            $libro->getDisponibilidad(),
            $id
        );
        return $stmt->execute();
    }
    public function eliminarLibro($id) {
        $sql = "DELETE FROM libros WHERE id_libro = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
