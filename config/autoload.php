<?php

//Autoloader qui trouve et charge les classes demandées par les  autres fichiers

spl_autoload_register(function ($className)
{
    $directories = [
        'models',
        'controllers',
        'repositories',
        'traits'
    ];

    foreach ($directories as $directory) {
        $file = dirname(__DIR__) . '/src/' . $directory . '/' . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});