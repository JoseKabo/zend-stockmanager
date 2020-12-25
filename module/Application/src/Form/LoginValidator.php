<?php

    namespace Application\Form;

    use Zend\InputFilter\InputFilter;

class LoginValidator extends InputFilter {
        public function __construct() {
            $this->add(
                [
                    'name' => 'correo',
                    'validators' => [
                        [
                            'name' => 'EmailAddress'
                        ]
                    ]
                ]
            );

            $this->add(
                [
                    'name' => 'contrasena',
                    
                    'validators' => [
                        [
                            'name' => 'StringLength',
                            'options' => [
                                'min' => 4,
                                'max' => 45,
                            ],
                        ]
                    ]
                ]
            );

        }
    }

?>