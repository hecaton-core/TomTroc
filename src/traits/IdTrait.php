<?php

//Trait pour les identifiants auto-incrémentés de la BDD
trait IdTrait
{
    //Valeur par défaut de l'id
    protected ?int $id = null;

    //Getter pour l'id
    public function getId(): ?int
    {
        return $this->id;
    }

    //Setter pour l'id
    public function setId(int $id): void
    {
        $this->id = $id;
    }
}