<?php
// Para conexión a base de datos

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'            => 'mysql:dbname=u960673546_pruebasTec;host=sql397.main-hosting.eu',
        'username' => 'u960673546_tec2k21',
        'password' => 'tecMante2k21',
        'driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ]
    ],
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
        'abstract_factories' => array(
            'Zend\Db\Adapter\AdapterAbstractServiceFactory',
        ),
    ),

];
