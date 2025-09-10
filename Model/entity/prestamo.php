<?php
class prestamo {
    private $id_prestamo;
    private $id_usuario;
    private $id_libro;
    private $fecha_prestamo;
    private $fecha_devolucion;
    private $devuelto;

    public function __construct($id_usuario, $id_libro, $fecha_prestamo, $fecha_devolucion = null, $devuelto = 0) {
        $this->id_usuario = $id_usuario;
        $this->id_libro = $id_libro;
        $this->fecha_prestamo = $fecha_prestamo;
        $this->fecha_devolucion = $fecha_devolucion;
        $this->devuelto = $devuelto;
    }

    public function getIdPrestamo() { return $this->id_prestamo; }
    public function getIdUsuario() { return $this->id_usuario; }
    public function getIdLibro() { return $this->id_libro; }
    public function getFechaPrestamo() { return $this->fecha_prestamo; }
    public function getFechaDevolucion() { return $this->fecha_devolucion; }
    public function getDevuelto() { return $this->devuelto; }

    public function setIdPrestamo($id_prestamo) { $this->id_prestamo = $id_prestamo; }
    public function setIdUsuario($id_usuario) { $this->id_usuario = $id_usuario; }
    public function setIdLibro($id_libro) { $this->id_libro = $id_libro; }
    public function setFechaPrestamo($fecha_prestamo) { $this->fecha_prestamo = $fecha_prestamo; }
    public function setFechaDevolucion($fecha_devolucion) { $this->fecha_devolucion = $fecha_devolucion; }
    public function setDevuelto($devuelto) { $this->devuelto = $devuelto; }
}
?>
