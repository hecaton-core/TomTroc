<?php

// Classe dédiée aux interactions avec la table books

Class BookRepository
{
    use DatabaseTrait;

    // Récupération de tous les livres et du pseudo de leurs propriétaires
    public function findAll(): array
    {
        $sql = "SELECT books.*, users.pseudo FROM books INNER JOIN users ON books.user_id = users.id ORDER BY books.created_at DESC, books.id DESC";
        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();

        $books = [];

        foreach ($rows as $row) {
            $books[] = $this->hydrateBook($row);
        }

        return $books;
    }

    // Hydratation d'un objet Book à partir des données SQL
    private function hydrateBook(array $row): Book
    {
        $book = new Book();

        $book->setId($row['id']);
        $book->setTitle($row['title']);
        $book->setAuthor($row['author']);
        $book->setImage($row['image']);
        $book->setDescription($row['description']);
        $book->setStatus($row['status']);
        $book->setUserId($row['user_id']);
        $book->setPseudo($row['pseudo']);

        return $book;
    }

    // Recherche de livres par titre ou auteur (via la barre de recherche du catalogue)
    public function search(string $search): array
    {
        $sql = "SELECT books.*, users.pseudo FROM books INNER JOIN users ON books.user_id = users.id WHERE books.title  
        LIKE :title OR books.author LIKE :author ORDER BY books.created_at DESC, books.id DESC";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'title' => '%' . $search . '%',
            'author' => '%' . $search . '%']);

        $rows = $statement->fetchAll();
        $books = [];

        foreach ($rows as $row) {
            $books[] = $this->hydrateBook($row);
        }

        return $books;
    }

    // Récupération d'un livre par son identifiant
    public function findById(int $id): ?Book
    {
        $sql = "SELECT books.*, users.pseudo FROM books INNER JOIN users ON books.user_id = users.id WHERE books.id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $row = $statement->fetch();

        if (!$row) {
            return null;
        }

        return $this->hydrateBook($row);
    }

    // Récupération des quatre derniers livres  ajoutés
    public function findLatest(): array
    {
        $sql = "SELECT books.*, users.pseudo FROM books INNER JOIN users ON books.user_id = users.id ORDER BY books.created_at DESC, 
        books.id DESC LIMIT 4";
        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();

        $books = [];

        foreach ($rows as $row) {
            $books[] = $this->hydrateBook($row);
        }

        return $books;
    }
};