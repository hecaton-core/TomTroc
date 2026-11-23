<?php

//Classe relative aux connexions avec la base de données SQL

class Database
{
    private static ?PDO $connection = null;

    // Methode renvoyant une connexion PDO unique ;
    // La connexion n'est créée QUE si elle n'existe pas déjà
    public static function getConnection(): PDO
        {
            if (self::$connection === null) {
            $config = require __DIR__ . '/config.php';
            $dsn = "mysql:host={$config['host']}; dbname={$config['dbname']}; charset={$config['charset']}";
            self::$connection = new PDO(
            $dsn,
            $config['username'],
            $config['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            }

            return self::$connection;
        }
};