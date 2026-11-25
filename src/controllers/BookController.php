<?php

class BookController
{
    // Méthode pour l'affichage de la page "Nos livres à l'échange" (action=catalog)
    public function catalog(): void
    {
        $bookRepository = new BookRepository();

        $search = trim($_GET['search'] ?? '');

        if ($search !== '') {
            $books = $bookRepository->search($search);
        } else {
            $books = $bookRepository->findAll();
        }

        require __DIR__ . '/../../views/books.php';
    }
};