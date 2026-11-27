<?php

// Initialisation de la session utilisateur
session_start();

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
        $controller = new BookController();
        $controller->book();
        break;

    case 'register':
        $controller = new UserController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register();
        } else {
            $controller->showRegister();
        }
        break;

    case 'login':
        $controller = new UserController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->showLogin();
        }
        break;

    case 'logout':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Méthode non-autorisée.');
        }
        $controller = new UserController();
        $controller->logout();
        break;

    default:
        echo "Erreur 404 : page introuvable";
        break;
}