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
}