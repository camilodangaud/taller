<?php
require_once __DIR__ . '/../Entity/usuario.php';
require_once __DIR__ . '/../Entity/conexion.php';
class usuario_crud{
    private $conexion;

    public function __construct() {
        $this->conexion = (new conexion())->conectar();
    }
    public function crearUsuario(Usuario $usuario) {
        $sql = "INSERT INTO usuarios (nombre, contrasena, tipo_usuario) VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sss", 
            $usuario->getNombre(), 
            $usuario->getContraseña(), 
            $usuario->getTipo()
        );
        return $stmt->execute();
    }
    public function actualizarUsuario($id, Usuario $usuario) {
        $sql = "UPDATE usuarios SET nombre = ?, contrasena = ?, tipo_usuario = ? WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sssi", 
            $usuario->getNombre(), 
            $usuario->getContraseña(), 
            $usuario->getTipo(),
            $id
        );
        return $stmt->execute();
    }
     public function eliminarUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>