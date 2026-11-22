<?php

//Classe relative aux connexions avec la base de données SQL

class Database
{
    //Methode renvoyant un objet PDO pour se connecter à la BDD
    public static function getConnection(): PDO
        {
            $config = require __DIR__ . '/config.php';
            $dsn = "mysql:host={$config['host']}; dbname={$config['dbname']}; charset={$config['charset']}";
            return new PDO(
            $dsn,
            $config['username'],
            $config['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        }
};