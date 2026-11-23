<?php

require_once __DIR__ . '/config/autoload.php';


$conversation = new Conversation();
$conversation->setId(1);
$conversation->setUser1Id(1);
$conversation->setUser2Id(2);

echo $conversation->getId();
echo '<br>';
echo $conversation->getuser1Id();
echo '<br>';
echo $conversation->getUser2Id();
echo '<br>';

require_once __DIR__ . '/config/Database.php';

$pdo1 = Database::getConnection();
$pdo2 = Database::getConnection();

var_dump($pdo1 === $pdo2);