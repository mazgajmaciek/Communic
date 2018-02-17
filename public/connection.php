<?php

//Poniżej napisz kod łączący się z bazą danych

include_once __DIR__ . '/../rest/config/db.php';
//try {
//    $connection = new PDO(sprintf("mysql:host=%s;dbname=%s", $hostname, $dbname), $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
//} catch (PDOException $ex) {
//    echo 'Connection failed: ' . $ex->getMessage();
//}

$response = [];
//connect to DB
try {
    $connection = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_DB.";charset=utf8"
        , DB_LOGIN, DB_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    $response = ['error' => 'DB Connection error: '.$e->getMessage()];
}

?>