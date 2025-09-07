<?php
require_once __DIR__ . '/../Entity/Usuario.php';
require_once __DIR__ . '/../Entity/Conexion.php';
class Usuario_crud{
    private $conexion;

    public function __construct() {
        $this->conexion = (new Conexion())->conectar();
    }
    
}
?>