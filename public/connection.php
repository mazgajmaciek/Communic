<?php

//Poniżej napisz kod łączący się z bazą danych

include_once '../config/db.php';

$connection = new PDO(sprintf("mysql:host=%s;dbname=%s", $hostname, $dbname), $user, $password);

if ($connection->errorCode() != null) {
    var_dump($connection->errorInfo());
    die();
}

Echo "Polaczenie";
