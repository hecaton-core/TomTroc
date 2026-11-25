<?php

require __DIR__ . '/partials/header.php'; ?>

<section class="catalog">

    <div class="catalog-header">
        <h1>Nos livres à l'échange</h1>

        <form action="index.php" method="GET" class="catalog-search">
            <input type="hidden" name="action" value="catalog">

            <input
                type="search"
                name="search"
                placeholder="Rechercher un livre"
                value="<?=  htmlspecialchars($search) ?>"
            >
        </form>
    </div>

    <?php if (empty($books)) { ?>
    <p class="catalog-no-results">Aucun livre ne correspond à votre recherche.</p>
    <?php } ?>
    <div class="catalog-grid">
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

</section>

<?php require __DIR__ . '/partials/footer.php'; ?>