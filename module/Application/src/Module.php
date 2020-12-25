<?php
namespace Application;

use Application\Model\Dao\IProductoDao;
use Application\Model\Dao\ProductoDao;
use Application\Model\Entity\Producto;
use mysqli_result;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

// Crear y registrar eventos de nuestra app como router 

class Module
{
    const VERSION = '3.1.3';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'ProductosTableGateway' => function ($sm){
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Producto());
                    return new TableGateway('zf3_products', $dbAdapter, null, $resultSetPrototype);
                },
                IProductoDao::class => function($sm){
                    $tableGateway = $sm->get('ProductoTableGateway');
                    $dao = new ProductoDao($tableGateway);
                    return $dao;
                }
            ]
        ];
    }
}
