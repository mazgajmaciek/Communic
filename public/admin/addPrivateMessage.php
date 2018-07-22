<?php

include_once '../bootstrap.php';

$prmess = new Privatemessage();

$prmess->setReadStatus(0);
$prmess->setReceiverId(6);
$prmess->setSenderId(4);
$prmess->setText("taka tam sobie fajna prywatna wiadomosc");
$prmess->saveToDB($conn);


var_dump($prmess);
