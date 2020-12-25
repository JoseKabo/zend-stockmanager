<?php

namespace Application\Controller;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

use Application\Model\Login;
use Application\Model\Dao\IProductoDao;

class ControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $controller = null;
        switch ($requestedName) {
            case InventarioController::class :
                    $productoDao = $container->get(IProductoDao::class);
                    $controller = new InventarioController($productoDao);
                break;
            case LoginController::class :
                    $login = $container->get(Login::class);
                    $controller = new LoginController($login);
                break;
            
            default:
                    return (null === $options) ? new $requestedName : new $requestedName;
                break;
        }
        return $controller;
    }
}
