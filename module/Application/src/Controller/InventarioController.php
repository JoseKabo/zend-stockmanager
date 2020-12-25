<?php

namespace Application\Controller;

use Application\Model\Dao\IProductoDao;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ArrayObject;
use Application\Model\Entity\Producto;
use Zend\View\Model\ViewModel;

class InventarioController extends AbstractActionController
{
    public $productoDao = null;

    public function __construct(IProductoDao $productoDao) {
        $this->productoDao = $productoDao;
    }

    public function indexAction()
    {
        return $this->redirect()->toRoute('inventario', ['action' => 'listar']);
    }
    public function listarAction()
    {
        return new ViewModel(
            [
                'productos' => $this->productoDao->obtenerProductos("1"),
                'titulo' => "Stock de tienda"
            ]
        );
    }
}
