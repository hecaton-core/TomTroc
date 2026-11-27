<?php

// Classe dédiée aux interactions avec la table users

Class UserRepository
{
    use DatabaseTrait;

    // Récupération de tous les utilisateurs
    public function findAll(): array
    {
        $sql = "SELECT users.* FROM users ORDER BY users.id ASC";
        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();

        $users = [];

        foreach ($rows as $row) {
            $users[] = $this->hydrateUser($row);
        }

        return $users;
    }

    // Hydratation d'un objet User à partir des données SQL
    private function hydrateUser(array $row): User
    {
        $user = new User();

        $user->setId($row['id']);
        $user->setPseudo($row['pseudo']);
        $user->setEmail($row['email']);
        $user->setPassword($row['password']);
        $user->setProfilePicture($row['profile_picture']);

        return $user;
    }

    // Récupération d'un User par son identifiant
    public function findById(int $id): ?User
    {
        $sql = "SELECT users.* FROM users WHERE users.id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $row = $statement->fetch();

        if (!$row) {
            return null;
        }

        return $this->hydrateUser($row);
    }

    // Récupération d'un User par son adresse email
    public function findByEmail(string $email): ?User
    {
        $sql = "SELECT users.* FROM users WHERE users.email = :email";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['email' => $email]);

        $row = $statement->fetch();

        if (!$row) {
            return null;
        }

        return $this->hydrateUser($row);
    }

    // Récupération d'un User par son pseudo
    public function findByPseudo(string $pseudo): ?User
    {
        $sql = "SELECT users.* FROM users WHERE users.pseudo = :pseudo";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['pseudo' => $pseudo]);

        $row = $statement->fetch();

        if (!$row) {
            return null;
        }

        return $this->hydrateUser($row);
    }

    // Création d'un nouvel utilisateur en BDD (utile pour création de compte)
    public function create(User $user): int
    {
        $sql = "INSERT INTO users (pseudo, email, password) VALUES (:pseudo, :email, :password)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword()
        ]);

        return (int) $this->pdo->lastInsertId();
    }
}