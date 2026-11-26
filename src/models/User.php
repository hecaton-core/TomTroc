<?php

//Classe dédiée aux utilisateurs

class User
{
    use IdTrait;
    private string $pseudo;
    private string $email;
    private string $password;
    private ?string $profilePicture = null;

    //Getter et setter du pseudo :
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    //Getter et setter de l'email :
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    //Getter et setter du mot de passe :
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

        //Getter et setter pour la photo de profil :
    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): void
    {
        $this->profilePicture = $profilePicture;
    }
}