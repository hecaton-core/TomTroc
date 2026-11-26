<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TomTroc</title>
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/style.css">
    </head>

    <body>
        <?php $currentAction = $_GET['action'] ?? 'home'; ?>
        <div class="site-container">
            <header>
                <nav class="header">
                    <div class="nav-left">
                        <a href="index.php?action=home"><img src="assets/images/navigation_logo.svg" alt ="TomTroc"></a>
                        <a href="index.php?action=home" class="<?= $currentAction === 'home' ? 'active' : '' ?>">Accueil</a>
                        <a href="index.php?action=catalog" class="<?= in_array($currentAction, ['catalog', 'book'], true) ? 'active' : '' ?>">Nos livres à l'échange</a>
                    </div>
                    <div class="nav-right">
                        <a href="index.php?action=messages" class="<?= $currentAction === 'messages' ? 'active' : '' ?>"><img src="assets/images/navigation_icone_messagerie.svg">Messagerie<span class="message-count">1</span></a>
                        <a href="index.php?action=profile" class="<?= $currentAction === 'profile' ? 'active' : '' ?>"><img src="assets/images/navigation_icone_compte.svg">Mon compte</a>
                        <a href="index.php?action=login" class="<?= $currentAction === 'login' ? 'active' : '' ?>">Connexion</a>
                    </div>
                </nav>
            </header>
            <main>