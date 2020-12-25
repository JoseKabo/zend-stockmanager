<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\Login as LoginForm;
use Application\Form\LoginValidator;
use Application\Model\Login as LoginService;
use Zend\View\Exception\RuntimeException;

class LoginController extends AbstractActionController
{
    private $login;

    public function __construct(LoginService $login) {
        $this->login = $login;
    }

    public function indexAction()
    {
        return [
            'titulo' => 'Inicar sesión',
            'form' => new LoginForm("login"),
            'identity' => $this->login->getIdentity()
        ];
    }

    public function autenticarAction()
    {
        if(!$this->request->isPost()){
            $this->redirect()->toRoute('login', ['action' => 'index']);
        }

        $form = new LoginForm("login");
        $form->setInputFilter(new LoginValidator());

        $data = $this->request->getPost();
        $form->setData($data);

        if(!$form->isValid()){
            $modelView = new ViewModel(
                [
                    'titulo' => 'Iniciar Sesion',
                    'form' => $form
                ]
            );
            $modelView->setTemplate('Application/login/index');
            return $modelView;
        }
        $values = $form->getData();

        try{
            $this->login->setMessage('Informacion incorrecta');
            $this->login->setMessage('Los campos no deben ser vacios');
            $this->login->login($values['correo'],$values['contrasena']);

            $this->flashMessenger()->addSuccessMessage('Sesion iniciada');
            $this->redirect()->toRoute('inventario', ['action' => 'index']);
        }catch(RuntimeException $e){
            $this->flashMessenger()->addErrorMesage('Error en login');
            $this->flashMessenger()->addErrorMesage($e->getMessage());
            $this->redirect()->toRoute('login', ['action' => 'index']);
        }

    }

    public function successAction()
    {
        return ['titulo' => 'Iniciar sesion con exito'];
    }
    
    public function logoutAction()
    {
        $this->login->logout();
        $this->flashMessenger()->addSuccessMessage('Sesión terminada');
        $this->redirect()->toRoute('login', ['action' => 'index']);
    }
}
