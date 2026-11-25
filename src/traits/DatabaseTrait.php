<?php

// Trait permettant de récupérer une connexion PDO

trait DatabaseTrait
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }    
};