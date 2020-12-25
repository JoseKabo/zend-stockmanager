<?php
    namespace Application\Model;
    
    use Zend\Authentication\AuthenticationService;
    use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter as AuthAdapter;
    use Zend\Authentication\Result;
    use RuntimeException;

    class Login {
        private $auth;
        private $authAdapter;

        const NOT_IDENTIFY = 'notIdentity';
        const INVALID_CREDENTIAL = 'invalidCredential';
        const INVALID_USER = 'invalidUser';
        const INVALID_LOGIN = 'invalidLogin';

        private $columnsToOmit = ['contrasena'];

        protected $messages = [
            self::NOT_IDENTIFY => "Usuario no encontrado",
            self::INVALID_CREDENTIAL => "Informacion incorrecta",
            self::INVALID_USER => "Correo incorrecto",
            self::INVALID_LOGIN => "Informacion incorrecta"
        ];

        public function __construct($dbAdapter, AuthenticationService $authService) {
            $this->authAdapter = new AuthAdapter($dbAdapter, 'zf3_users', 'correo', 'contrasena');
            $this->auth = $authService;
        }

        public function login($identifier, $password)
        {
            if (!empty($identifier) && !empty($password)){
                $this->authAdapter->setIdentity($identifier);
                $this->authAdapter->setCredential($password);

                $result = $this->auth->authenticate($this->authAdapter);
                switch ($result->getCode()) {
                    case Result::FAILURE_IDENTITY_NOT_FOUND:
                            throw new RuntimeException($this->messages[self::NOT_IDENTIFY]);
                        break;
                    case Result::FAILURE_CREDENTIAL_INVALID:
                            throw new RuntimeException($this->messages[self::INVALID_CREDENTIAL]);
                        break;
                    case Result::SUCCESS:
                            if($result->isValid()){
                                $data = $this->authAdapter->getResultRowObject(null, $this->columnsToOmit);
                                $this->auth->getStorage()->write($data);
                            }else{
                                throw new RuntimeException($this->messages[self::INVALID_USER]);
                            }
                        break;
                    default:
                        throw new RuntimeException($this->messages[self::INVALID_LOGIN]);
                    break;
                }
            } else {
                throw new RuntimeException($this->messages[self::INVALID_LOGIN]);
            }
            return $this;
        }

        public function logout()
        {
            $this->auth->clearIdentity();
            return $this;
        }
        public function getIdentity()
        {
            if($this->auth->hasIdentity()){
                return $this->auth->getIdentity();
            }
            return null;
        }
        public function isLoggedIn()
        {
            return $this->auth->hasIdentity();
        }

       public function setMessage($messageString, $messageKey =null)
       {
           if($messageKey === null){
               $keys = array_keys($this->messages);
               $messageKey = current($keys);
           }
           if(!isset($this->messages[$messageKey])){
               throw new \Exception("No message exists for key '$messageKey'");
               
           }
           $this->messages[$messageKey] = $messageString;
           return $this;
        }

        public function setMessages(array $messages)
        {
            foreach ($messages as $key => $message) {
                $this->setMessage($message, $key);
            }
            return $this;
        }
    }

?>
