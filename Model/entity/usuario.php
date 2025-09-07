<?php
class usuario {
    private $nombre;
    private $correo;
    private $contraseña;
    private $tipo;


    public function __construct($nombre, $correo, $contraseña, $tipo) {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->contraseña = $contraseña;
        $this->tipo = $tipo;
        
    }

    public function getNombre() { return $this->nombre; }    
    public function getCorreo() { return $this->correo; }
    public function getContraseña() { return $this->contraseña; }
    public function getTipo() { return $this->tipo; }


    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setCorreo($correo) { $this->correo = $correo; }
    public function setContraseña($contraseña) { $this->contraseña = $contraseña; }
    public function setTipo($tipo) { $this->tipo = $tipo; }

}
?>