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

    // Méthode pour l'affichage d'une page livre (action=book)
    public function book(): void
    {
        $bookRepository = new BookRepository();

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        $book = $id > 0 ? $bookRepository->findById($id) : null;

        if ($book === null) {
            http_response_code(404);
            require __DIR__ . '/../../views/404.php';
            return;
        }
        
        // Récupération du propriétaire du livre
        $userRepository = new UserRepository();
        $owner = $userRepository->findById($book->getUserId());
        
        require __DIR__ . '/../../views/book.php';
    }
};