<?php
// Para conexión a base de datos

return [
    'db' => [
        'driver' => 'Pdo_Mysql',
        'database' => 'u960673546_pruebasTec',
        'hostname' => '5.181.218.28',
        'driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ]
    ]
];
