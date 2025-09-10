<?php
class reserva {
    private $id_reserva;
    private $id_usuario;
    private $id_libro;
    private $fecha_reserva;
    private $activa;

    public function __construct($id_usuario, $id_libro, $fecha_reserva, $activa = 1) {
        $this->id_usuario = $id_usuario;
        $this->id_libro = $id_libro;
        $this->fecha_reserva = $fecha_reserva;
        $this->activa = $activa;
    }

    public function getIdReserva() { return $this->id_reserva; }
    public function getIdUsuario() { return $this->id_usuario; }
    public function getIdLibro() { return $this->id_libro; }
    public function getFechaReserva() { return $this->fecha_reserva; }
    public function getActiva() { return $this->activa; }

    public function setIdReserva($id_reserva) { $this->id_reserva = $id_reserva; }
    public function setIdUsuario($id_usuario) { $this->id_usuario = $id_usuario; }
    public function setIdLibro($id_libro) { $this->id_libro = $id_libro; }
    public function setFechaReserva($fecha_reserva) { $this->fecha_reserva = $fecha_reserva; }
    public function setActiva($activa) { $this->activa = $activa; }
}
?>
