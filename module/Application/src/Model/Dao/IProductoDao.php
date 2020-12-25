<?php

    namespace Application\Model\Dao;
    use Application\Model\Entity\Producto;

    interface IProductoDao {
        public function obtenerProductos($id_stock);
        public function guardarProducto(Producto $producto);
        public function eliminarProducto(Producto $producto);
    }

?>