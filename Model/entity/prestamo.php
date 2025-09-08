<?php
class prestamo {
    private $fecha_prestamo;
    private $fecha_devolucion;
    private $devuelto;

    public function __construct($fecha_prestamo, $fecha_devolucion = null, $devuelto = 0) {
        $this->fecha_prestamo = $fecha_prestamo;
        $this->fecha_devolucion = $fecha_devolucion;
        $this->devuelto = $devuelto;
    }

    public function getFechaPrestamo() { return $this->fecha_prestamo; }
    public function getFechaDevolucion() { return $this->fecha_devolucion; }
    public function getDevuelto() { return $this->devuelto; }

    public function setFechaPrestamo($fecha_prestamo) { $this->fecha_prestamo = $fecha_prestamo; }
    public function setFechaDevolucion($fecha_devolucion) { $this->fecha_devolucion = $fecha_devolucion; }
    public function setDevuelto($devuelto) { $this->devuelto = $devuelto; }
}
?>
