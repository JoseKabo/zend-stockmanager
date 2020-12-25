<?php

    namespace Application\Form;
    use Zend\Form\Form;
    use Zend\Form\Element;
    class Login extends Form{
        public function __construct($name = null) {
            parent::__construct($name);

            // Login form
            $this->add(
                [
                    'type' => Element\Email::class,
                    'name' => 'correo',
                    'attributes' => [
                        'class' => 'form-control',
                        'style' => ''
                    ],
                    'options' => [
                        'label' => 'Correo electronico',
                        'label_attributes' => [
                            'class' => '',
                            'style' => ''
                        ]
                    ]
                ]
            );
            $this->add(
                [
                    'type' => Element\Password::class,
                    'name' => 'contrasena',
                    'attributes' => [
                        'class' => 'form-control',
                        'style' => ''
                    ],
                    'options' => [
                        'label' => 'Contraseña',
                        'label_attributes' => [
                            'class' => '',
                            'style' => ''
                        ]
                    ]
                ]
            );
            $this->add(
                [
                    'name' => 'send',
                    'attributes' => [
                        'type' => 'submit',
                        'value' =>'Login',
                        'class' => 'btn btn-primary btn-block'
                    ]
                ]
            );
        }
    }

?>