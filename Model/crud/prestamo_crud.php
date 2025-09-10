<?php
require_once('../../Model/entity/conexion.php');
require_once('../../Model/entity/prestamo.php');

class prestamo_crud {
    private $conexion;

    public function __construct() {
        $db = new conexion();
        $this->conexion = $db->conectar();
    }

    public function insertar_prestamo(prestamo $prestamo) {
        $stmt = $this->conexion->prepare(
            "INSERT INTO prestamos (id_usuario, id_libro, fecha_prestamo, devuelto) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("iisi", 
            $prestamo->getIdUsuario(),
            $prestamo->getIdLibro(),
            $prestamo->getFechaPrestamo(),
            $prestamo->getDevuelto()
        );

        if ($stmt->execute()) {
            $update = $this->conexion->prepare(
                "UPDATE libros SET disponibilidad = 0 WHERE id_libro = ?"
            );
            $id_libro = $prestamo->getIdLibro();
            $update->bind_param("i", $id_libro);
            $update->execute();

            return true;
        } else {
            return false;
        }
    }
}
?>