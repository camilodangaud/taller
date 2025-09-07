<?php
require_once __DIR__ . '/../Entity/usuario.php';
require_once __DIR__ . '/../Entity/conexion.php';
class usuario_crud{
    private $conexion;

    public function __construct() {
        $this->conexion = (new conexion())->conectar();
    }
    public function crearUsuario(usuario $usuario) {
        $sql = "INSERT INTO usuarios (nombre, correo, contrasena, tipo_usuario) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssss", 
            $usuario->getNombre(), 
            $usuario->getCorreo(), 
            $usuario->getContraseña(), 
            $usuario->getTipo()
        );
        return $stmt->execute();
    }
    public function actualizarUsuario($id, usuario $usuario) {
        $sql = "UPDATE usuarios SET nombre = ?, correo = ?, contrasena = ?, tipo_usuario = ? WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssssi", 
            $usuario->getNombre(), 
            $usuario->getCorreo(), 
            $usuario->getContraseña(), 
            $usuario->getTipo(),
            $id
        );
        return $stmt->execute();
    }
   public function loginUsuario($correo, $contrasena) {
    $sql = "SELECT * FROM usuarios WHERE correo = ? AND contrasena = ?";
    $stmt = $this->conexion->prepare($sql);
    $stmt->bind_param("ss", $correo, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return new usuario(
            $row['nombre'],
            $row['correo'],
            $row['contrasena'],
            $row['tipo_usuario']
        );
    }
    return null;
}

public function eliminarUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>