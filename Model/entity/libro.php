<?php
class libro {
    private $titulo;
    private $autor;
    private $editorial;
    private $disponibilidad;
    public function __construct($titulo, $autor, $editorial, $disponibilidad) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->disponibilidad = $disponibilidad;
    }

    public function getTitulo() { return $this->titulo; }
    public function getAutor() { return $this->autor; }
    public function getEditorial() { return $this->editorial; }
    public function getDisponibilidad() { return $this->disponibilidad; }

    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setAutor($autor) { $this->autor = $autor; }
    public function setEditorial($editorial) { $this->editorial = $editorial; }
    public function setDisponibilidad($disponibilidad) { $this->disponibilidad = $disponibilidad; }
}
?>
