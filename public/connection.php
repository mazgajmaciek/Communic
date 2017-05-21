<?php

//Poniżej napisz kod łączący się z bazą danych

include_once __DIR__ . '/../config/db.php';
try {
    $connection = new PDO(sprintf("mysql:host=%s;dbname=%s", $hostname, $dbname), $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $ex) {
    echo 'Connection failed: ' . $ex->getMessage();
}


//if ($connection->errorCode() != null) {
//    var_dump($connection->errorInfo());
//    die();
//}
?>