<?php

//Autoloader qui trouve et charge les classes demandées par les  autres fichiers

spl_autoload_register(function ($className)
{
    $directories = [
        'src/models',
        'src/controllers',
        'src/repositories',
        'src/traits',
        'config'
    ];

    foreach ($directories as $directory) {
        $file = dirname(__DIR__) . '/' . $directory . '/' . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});