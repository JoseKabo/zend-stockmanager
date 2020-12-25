<?php
namespace Application;

use Application\Model\Dao\IProductoDao;
use Application\Model\Dao\ProductoDao;
use Application\Model\Entity\Producto;
use Application\Model\Login;
use Application\Model\LoginService;
use mysqli_result;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\Factory\InvokableFactory;

// Crear y registrar eventos de nuestra app como router 

class Module
{
    const VERSION = '3.1.3';
    public function onBootstrap($e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, [
            $this, 'initAuth'
        ], 100
        );
    }
    public function initAuth(MvcEvent $e)
    {
        $application = $e->getApplication();
        $serviceManager = $application->getServiceManager();
        $auth = $serviceManager->get(Login::class);

        $layout = $e->getViewModel();
        $layout->auth = $auth;

        $matches = $e->getRouteMatch();
        $controllerName = $matches->getParam('controller');
        $action = $matches->getParam('action');

        switch ($controllerName) {
            case Controller\LoginController::class:
                if(in_array($action, ['index', 'autenticar'])){
                    return;
                }
                break;
            default:
                
                break;
        }
        if(!$auth->isLoggedIn()){
            $matches->setParam('controller', Controller\LoginController::class);
            $matches->setParam('action', 'index');
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'ProductoTableGateway' => function ($sm){
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Producto());
                    return new TableGateway('zf3_products', $dbAdapter, null, $resultSetPrototype);
                },
                IProductoDao::class => function($sm){
                    $tableGateway = $sm->get('ProductoTableGateway');
                    $dao = new ProductoDao($tableGateway);
                    return $dao;
                },
                AuthenticationService::class => InvokableFactory::class,
                Login::class => function($sm){
                    $dbAdapter = $sm->get(AdapterInterface::class);
                    $authService = $sm->get(AuthenticationService::class);
                    return new Login($dbAdapter, $authService);
                },
                // UsuarioDao::class => function($sm){
                //     return new UsuarioDao();
                // }
            ],
            'aliases' => [
                'auth_service' => AuthenticationService::class,
            ],
        ];
    }
}
