<?php

// Chargement de l'autoloader
require_once __DIR__ . '/config/autoload.php';

// Récupération de l'action demandée en requête HTTP
$action = $_GET['action'] ?? 'home';

//Routage vers les différentes pages
switch ($action) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    case 'catalog':
        $controller = new BookController();
        $controller->catalog();
        break;

    case 'book':
        echo "Fiche détaillée d'un livre";
        break;

    default:
        echo "Erreur 404 : page introuvable";
        break;
}