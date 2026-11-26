<?php require __DIR__ . '/partials/header.php'; ?>

<section class="home-intro">
    <div class="intro-content">
        <h1>Rejoignez nos lecteurs passionnés</h1>
        <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. 
            Nous croyons en la magie du partage des connaissances et d'histoires à travers les livres.
        </p>
        <a href="index.php?action=catalog" class="intro-button">Découvrir</a>
    </div>
    <figure class="intro-image"><img src="assets/images/home_bibliotheque_large.png" alt="Une librairie remplie de livres">
        <figcaption>Hamza</figcaption>
    </figure>
</section>

<section class="home-latest-books">
    <h2>Les derniers livres ajoutés</h2>
    <div class="latest-books-grid">
        <?php 
        foreach ($books as $book) {?>
        <article class="book-card">
            <a href="index.php?action=book&id=<?= $book->getId(); ?>" class="book-card-link">
                <div class="book-cover">
                    <img class="book-image" src="assets/images/<?= htmlspecialchars($book->getImage()); ?>
                    " alt="Photo du livre <?=htmlspecialchars ($book->getTitle());?>"><?php if ($book->getStatus() === 'indisponible') { ?>
                    <img class="status-badge" src="assets/images/book_status_unavailable.svg" alt="non dispo."><?php } ?>
                </div>
            <h3><?=htmlspecialchars($book->getTitle());?></h3>
            <p class="book-author"><?= htmlspecialchars($book->getAuthor());?></p>
            <p class="book-owner">Proposé par : <?= htmlspecialchars($book->getPseudo());?></p></a>
        </article>
        <?php } ?>      
    </div>
    <a href="index.php?action=catalog" class="latest-books-button">Voir tous les livres</a>
</section>

<section class="home-steps">
    <h2>Comment ça marche ?</h2>
    <p class="steps-description">Échanger des livres avec TomTroc c'est simple et amusant ! Suivez ces étapes pour commencer :</p>
    <div class="steps-grid">
        <div class="step-card">
            <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
        </div>
        <div class="step-card">
            <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
        </div>
        <div class="step-card">
            <p>Parcourez les livres disponibles chez d'autres membres.</p>
        </div>
        <div class="step-card">
            <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
        </div>
    </div>
    <a href="index.php?action=catalog" class="steps-button">Voir tous les livres</a>
</section>

<section class="home-values">
    <img src="assets/images/home_bandeau_rayonnage.png" alt="lectrice devant une bibliotheque" class="values-banner">
    <div class="values-content">
        <h2>Nos valeurs</h2>
        <p>Chez Tom Troc, nous mettons l'accent sur le partage,la découverte et la communauté. Nos valeurs sont ancrées 
            dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance 
            des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
        <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.</p>
        <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager 
            leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
        <div class="values-signature">
            <span>L'équipe Tom Troc</span><img src="assets/images/home_coeur_vert_vectoriel.svg" alt="">
        </div>
    </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>