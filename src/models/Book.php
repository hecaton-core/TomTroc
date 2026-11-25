<?php

//Classe dédiée aux livres

class Book
{
    use IdTrait;
    private string $title;
    private string $author;
    private string $image = 'book_placeholder.png';
    private string $description;
    private string $status;
    private int $userId;
    private string $pseudo;

    //Getter et setter du titre :
    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    //Getter et setter de l'auteur :
    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    //Getter et setter de l'image :
    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    //Getter et setter de la description :
    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    //Getter et setter du statut :
    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    //Getter et setter de l'identifiant de l'utilisateur :
    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    //Getter et setter du pseudo de l'utilisateur :
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }
}