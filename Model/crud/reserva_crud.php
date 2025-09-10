<?php
require_once('../../Model/entity/conexion.php');
require_once('../../Model/entity/Reserva.php');

class reserva_crud {
    private $conexion;

    public function __construct() {
        $db = new conexion();
        $this->conexion = $db->conectar();
    }

    public function insertar_reserva(reserva $reserva) {
        $stmt = $this->conexion->prepare(
            "INSERT INTO reservas (id_usuario, id_libro, fecha_reserva, activa) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("iisi", 
            $reserva->getIdUsuario(),
            $reserva->getIdLibro(),
            $reserva->getFechaReserva(),
            $reserva->getActiva()
        );

        if ($stmt->execute()) {
            $update = $this->conexion->prepare(
                "UPDATE libros SET disponibilidad = 0 WHERE id_libro = ?"
            );
            $id_libro = $reserva->getIdLibro();
            $update->bind_param("i", $id_libro);
            $update->execute();

            return true;
        } else {
            return false;
        }
    }
}
?>
