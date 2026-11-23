<?php

//Classe dédiée aux conversations
//N.B.: Les 'conversations' établissent le lien entre deux utilisateurs nommés user1 et user2
//Les messages qu'ils s'échangent sont traités séparément via la classe Message.

class Conversation
{
    use IdTrait;
    private int $user1Id;
    private int $user2Id;

    //Getter et setter du user1Id :
    public function getUser1Id(): int
    {
        return $this->user1Id;
    }

    public function setUser1Id(int $user1Id): void
    {
        $this->user1Id = $user1Id;
    }

    //Getter et setter du user2Id :
    public function getUser2Id(): int
    {
        return $this->user2Id;
    }

    public function setUser2Id(int $user2Id): void
    {
        $this->user2Id = $user2Id;
    }
}