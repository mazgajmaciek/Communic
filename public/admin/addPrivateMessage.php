<?php

include_once '../bootstrap.php';

$prmess = new PrivateMessage();

$prmess->setReadStatus(0);
$prmess->setReceiverId(6);
$prmess->setSenderId(4);
$prmess->setText("taka tam sobie fajna prywatna wiadomosc");
$prmess->saveToDB($connection);


var_dump($prmess);
