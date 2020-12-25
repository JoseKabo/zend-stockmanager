<?php
    namespace Application\Model\Entity;
    use Zend\Form\Annotation;
 
    /**
     * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
     * @Annotation\Name("User")
     */
    class Login
    {
        /**
         * @Annotation\Type("Zend\Form\Element\Text")
         * @Annotation\Required({"required":"true" })
         * @Annotation\Filter({"name":"StripTags"})
         * @Annotation\Options({"label":"Username:"})
         */
        public $correo;
         
        /**
         * @Annotation\Type("Zend\Form\Element\Password")
         * @Annotation\Required({"required":"true" })
         * @Annotation\Filter({"name":"StripTags"})
         * @Annotation\Options({"label":"Password:"})
         */
        public $contra;
    }

?>
