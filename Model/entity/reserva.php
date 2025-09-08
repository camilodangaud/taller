<?php
class Reserva {
    private $fecha_reserva;
    private $activa;

    public function __construct($fecha_reserva, $activa = 1) {
        $this->fecha_reserva = $fecha_reserva;
        $this->activa = $activa;
    }

    public function getFechaReserva() { return $this->fecha_reserva; }
    public function getActiva() { return $this->activa; }

    public function setFechaReserva($fecha_reserva) { $this->fecha_reserva = $fecha_reserva; }
    public function setActiva($activa) { $this->activa = $activa; }
}
?>
