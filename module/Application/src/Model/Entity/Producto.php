<?php
    namespace Application\Model\Entity;

    class Producto {

        private $id;
        private $nombre;
        private $descripcion;
        private $cantidad;
        private $precio;

        public function __construct($id, $nombre, $descripcion,$cantidad, $precio) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->cantidad = $cantidad;
            $this->precio = $precio;
        }

        public function getId()
        {
            return $this->id;
        }
        public function getNombre()
        {
            return $this->nombre;
        }
        public function getDescripcion()
        {
            return $this->descripcion;
        }
        public function getCantidad()
        {
            return $this->cantidad;
        }
        public function getPrecio()
        {
            return $this->precio;
        }
    }

?>
