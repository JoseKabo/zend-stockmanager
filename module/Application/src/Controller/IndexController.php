<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function listarAction()
    {
        return [
            "productos" => [
                "TV",
                "Noebook",
                "Libro"
            ],
            "titulo" => "Listar Acción"
        ];
    }
}
