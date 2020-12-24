<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\ArrayObject;
use Application\Model\Entity\Producto;
use Zend\View\Model\ViewModel;

class InventarioController extends AbstractActionController
{
    public $listaProductos = null;

    public function __construct() {
        $this->listaProductos = new ArrayObject();

        $this->listaProductos->append(new Producto(1,"Chocolate","280 gr.","45","4.00 MXN"));
        $this->listaProductos->append(new Producto(2,"Paleta Vero","80 gr.","15","5.00 MXN"));
    }

    public function indexAction()
    {
        return $this->redirect()->toRoute('inventario', ['action' => 'listar']);
    }
    public function listarAction()
    {
        return new ViewModel(
            [
                'listaProductos' => $this->listaProductos,
                'titulo' => "Stock de tienda"
            ]
        );
    }
}
