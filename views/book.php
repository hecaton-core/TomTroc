<?php require __DIR__ . '/partials/header.php'; ?>

<div class="book-breadcrumb-wrapper">
    <nav class="book-breadcrumb" aria-label="Fil d'Ariane">
        <a href="index.php?action=catalog">Nos livres</a>
        <span>&gt;</span>
        <span><?= htmlspecialchars($book->getTitle()) ?></span>
    </nav>
</div>

<section class="book-detail">

    <div class="book-detail-image">
        <img
            src="assets/images/<?= htmlspecialchars($book->getImage()) ?>"
            alt="Photo du livre <?= htmlspecialchars($book->getTitle()) ?>"
        >
    </div>

    <div class="book-detail-content">
        <h1><?= htmlspecialchars($book->getTitle()) ?></h1>
        <p class="book-detail-author">
            par <?= htmlspecialchars($book->getAuthor()) ?>
        </p>

        <hr class="book-detail-divider">
        <h2>Description</h2>

        <p class="book-detail-description">
            <?= nl2br(htmlspecialchars($book->getDescription())) ?>
        </p>

        <?php if ($owner !== null): ?>
        <h2 class="book-detail-owner-title">Propriétaire</h2>
        <a class="owner-badge" href="index.php?action=profile&id=<?= $owner->getId() ?>">
            <div class="owner-avatar">
                <img src="assets/images/<?= htmlspecialchars($owner->getProfilePicture() ?: 'default_avatar.png') ?>"
                alt="Photo de profil">
            </div>
            <span><?= htmlspecialchars($owner->getPseudo()) ?></span>
            
        </a>
        <a class="book-message-button"
            href="index.php?action=messaging&userId=<?= $owner->getId() ?>">
            Envoyer un message
        </a>
        <?php endif; ?>
    </div>

</section>

<?php require __DIR__ . '/partials/footer.php'; ?>