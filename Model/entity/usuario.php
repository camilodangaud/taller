<?php
class usuario {
    private $nombre;
    private $contraseña;
    private $tipo;

    public function __construct($nombre, $contraseña, $tipo) {
        $this->nombre = $nombre;
        $this->contraseña = $contraseña;
        $this->tipo = $tipo;
    }

    public function getNombre() { return $this->nombre; }
    public function getContraseña() { return $this->contraseña; }
    public function getTipo() { return $this->tipo; }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setContraseña($contraseña) { $this->contraseña = $contraseña; }
    public function setTipo($tipo) { $this->tipo = $tipo; }
}
?>