<?php
namespace Application;
// Crear y registrar eventos de nuestra app como router 
class Module
{
    const VERSION = '3.1.3';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
