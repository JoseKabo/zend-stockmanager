<?php

    namespace Application\Model\Dao;

    use Zend\db\TableGateway\TableGateway;
    use Application\Model\Entity\Producto;
    use RuntimeException;

    class ProductoDao implements IProductoDao
    {
        protected $tableGateway;

        public function __construct(TableGateway $tableGateway) {
            $this->tableGateway = $tableGateway;
        }

        public function guardarProducto(Producto $producto){

        }
        public function eliminarProducto(Producto $producto){

        }
        public function obtenerProductos($id_stock){
            $rowSet = $this->tableGateway->select(
                [
                    'id_stock' => (int) $id_stock
                ]
            );
            if(!$rowSet){
                throw new RuntimeException("No hay productos para este stock MIK");
            }
            return $rowSet;
        }
    }
    

?>