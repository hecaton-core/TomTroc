<?php

//Classe dédiée aux messages
//N.B.: cette classe traite les messages en récupérant notamment leur expéditeur et
//la conversation dont ils sont extrait, ainsi que leur contenu et date d'émission.

class Message
{
    use IdTrait;
    private int $conversationId;
    private int $senderId;
    private string $content;
    private DateTime $dateCreated;

    //Getter et setter de l'identifiant de la conversation :
    public function getConversationId(): int
    {
        return $this->conversationId;
    }

    public function setConversationId(int $conversationId): void
    {
        $this->conversationId = $conversationId;
    }

    //Getter et setter de l'identifiant de l'expéditeur :
    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function setSenderId(int $senderId): void
    {
        $this->senderId = $senderId;
    }

    //Getter et setter du contenu du message :
    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    //Getter et setter de la date d'envoi :
    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    public function setDateCreated(string $dateCreated): void
    {
        $this->dateCreated = new DateTime($dateCreated);
    }
}