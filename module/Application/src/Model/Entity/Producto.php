<?php
    namespace Application\Model\Entity;

    class Producto {

        private $id_producto;
        private $nombre;
        private $descripcion;
        private $cantidad;
        private $costo_unit;
        private $url_image;
        private $id_stock;

        #region Setters and getters
        public function getUrl_image()
        {
            return $this->url_image;
        }
        public function setUrl_image($url_image)
        {
            $this->url_image = $url_image;
        }
        public function getId_stock()
        {
            return $this->id_stock;
        }
        public function setId_stock($id_stock)
        {
            $this->id_stock = $id_stock;
        }
        public function getId_producto()
        {
            return $this->id_producto;
        }
        public function setId_producto($id_producto)
        {
            $this->id_producto = $id_producto;
        }
        public function getNombre()
        {
            return $this->nombre;
        }
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }
        public function getDescripcion()
        {
            return $this->descripcion;
        }
        public function setDescripcion($descripcion)
        {
            $this->descripcion = $descripcion;
        }
        public function getCantidad()
        {
            return $this->cantidad;
        }
        public function setCantidad($cantidad)
        {
            $this->cantidad = $cantidad;
        }
        public function getCosto_unit()
        {
            return $this->costo_unit;
        }
        public function setcosto_unit($costo_unit)
        {
            $this->costo_unit = $costo_unit;
        }
        #endregion
        public function exchangeArray($data)
        {
            $this->id_producto = (isset($data['id_producto'])) ? $data['id_producto'] : null;
            $this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
            $this->descripcion = (isset($data['descripcion'])) ? $data['descripcion'] : null;
            $this->cantidad = (isset($data['cantidad'])) ? $data['cantidad'] : null;
            $this->costo_unit = (isset($data['costo_unit'])) ? $data['costo_unit'] : null;
            $this->url_image = (isset($data['url_image'])) ? $data['url_image'] : null;
            $this->id_stock = (isset($data['id_stock'])) ? $data['id_stock'] : null;
        }
        public function getArrayCopy()
        {
            return get_object_vars($this);
        }
    }

?>
