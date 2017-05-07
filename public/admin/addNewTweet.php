<?php

include_once '../bootstrap.php';

$tweet = new Tweet();

var_dump($_SESSION);


$userId = $_SESSION['userId'];


$tweet->setText('wiadomosc testowa');
$tweet->setUserId($userId);



$tweet->saveToDB($connection);

