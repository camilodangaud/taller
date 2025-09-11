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
     public function devolver_prestamo($id_prestamo, $id_libro) {
        $stmt = $this->conexion->prepare(
            "UPDATE prestamos 
             SET devuelto = 1, fecha_devolucion = NOW() 
             WHERE id_prestamo = ?"
        );
        $stmt->bind_param("i", $id_prestamo);

        if ($stmt->execute()) {
            $update = $this->conexion->prepare(
                "UPDATE libros SET disponibilidad = 1 WHERE id_libro = ?"
            );
            $update->bind_param("i", $id_libro);
            $update->execute();

            return true;
        } else {
            return false;
        }
    }
}
?>