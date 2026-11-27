<?php

// Classe dédiée à la gestion des utilisateurs
class UserController
{
    use CsrfProtectionTrait;

    // Affichage de la page d'inscription
    public function showRegister(): void
    {
        // Génération du jeton CSRF si inexistant
        // (CSRF : protection contre les soumissions de formulaires frauduleuses
        // provenant de sites tiers)
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Initialisation des variables du formulaire d'inscription
        $errors = [];
        $pseudo = '';
        $email = '';

        require __DIR__ . '/../../views/register.php';
    }

    // Traitement du formulaire d'inscription
    public function register(): void
    {
        // Vérification du jeton CSRF
        $this->verifyCsrfToken();

        // Récupération des données du formulaire
        $pseudo = trim((string) filter_input(INPUT_POST, 'pseudo'));
        $email = trim((string) filter_input(INPUT_POST, 'email'));
        $password = (string) filter_input(INPUT_POST, 'password');

        $errors = [];

        // Validation du pseudo
        if (mb_strlen($pseudo) < 3
            || mb_strlen($pseudo) > 50) {
                $errors[] = 'Le pseudo doit contenir entre 3 et 50 caractères.';
            }

        // Validation de l'adresse email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)
            || strlen($email) > 255) {
                $errors[] = "L'adresse email est invalide.";    
            }

        // Validation du mot de passe
        if (mb_strlen($password) < 10
            || !preg_match('/[A-Z]/', $password)
            || !preg_match('/[a-z]/', $password)
            || !preg_match('/[0-9]/', $password)) {
                $errors[] = 'Le mot de passe doit contenir au moins 10 caractères, une majuscule, une minuscule et un chiffre.';
            }

        // Vérification de la compatibilité avec bcrypt
        if (strlen($password) > 72
            || str_contains($password, "\0")) {
                $errors[] = 'Le mot de passe dépasse la longueur autorisée ou contient un caractère interdit.';
            }

        // Vérification de la disponibilité du pseudo et de l'email
        $userRepository = new UserRepository();
        if (empty($errors)) {
            if ($userRepository->findByPseudo($pseudo)!== null) {
                $errors[] = 'Ce pseudo est déjà utilisé.';
            }

            if ($userRepository->findByEmail($email) !== null) {
                $errors[] = 'Cette adresse e-mail est déjà utilisée.';
            }
        }

        // Réaffichage du formulaire d'inscription en cas d'erreur
        if (!empty($errors)) {
            require __DIR__ . '/../../views/register.php';
            return;
        }

        // Création du nouvel objet User
        $user = new User();

        $user->setPseudo($pseudo);
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        // Enregistrement du nouvel utilisateur en BDD
        try {
            $userId = $userRepository->create($user);
        } catch (PDOException $e) {
            error_log($e->getMessage());

            $errors[] = 'Impossible de créer le compte. Veuillez réessayer.';

            require __DIR__ . '/../../views/register.php';
            return;
        }

        // Connexion automatique du nouvel utilisateur
        session_regenerate_id(true);
        $_SESSION['user_id'] = $userId;

        // Renouvellement du jeton CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Redirection après inscription
        header('Location: index.php?action=home');
        exit;
    }

    // Affichage de la page de connexion
    public function showLogin(): void
    {
        // Génération du jeton CSRF si inexistant
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Initialisation des variables du formulaire de connexion
        $errors = [];
        $email = '';

        require __DIR__ . '/../../views/login.php';
    }

    // Traitement du formulaire de connexion
    public function login(): void
    {
        // Vérification du jeton CSRF
        $this->verifyCsrfToken();

        // Récupération des données du formulaire
        $email = trim((string) filter_input(INPUT_POST, 'email'));
        $password = (string) filter_input(INPUT_POST, 'password');

        $errors = [];

        // Validation des données
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)
            || strlen($email) > 255
            || $password === ''
            || strlen($password) > 72
            || str_contains($password, "\0")) {
                $errors[] = 'Identifiants incorrects.';
            }

        // Recherche et authentification de l'utilisateur
        if (empty($errors)) {
            $userRepository = new UserRepository();
            $user = $userRepository->findByEmail($email);

            if ($user === null
            || !password_verify($password, $user->getPassword())) {
                $errors[] = 'Identifiants incorrects.';
            }
        }

        // Réaffichage du formulaire en cas d'erreur
        if (!empty($errors)) {
            require __DIR__ . '/../../views/login.php';
            return;
        }

        // Connexion de l'utilisateur
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user->getId();

        // Renouvellement du jeton CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Redirection après connexion réussie
        header('Location: index.php?action=home');
        exit;
    }

    // Déconnexion de l'utilisateur
    public function logout(): void
    {
        // Vérification du jeton CSRF
        $this->verifyCsrfToken();

        // Suppression de l'identifiant utilisateur en session
        unset($_SESSION['user_id']);

        // Renouvellement de l'identifiant de session
        session_regenerate_id(true);

        // Renouvellement du jeton CSRF
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // Redirection vers l'accueil
        header('Location: index.php?action=home');
        exit;
    }
}