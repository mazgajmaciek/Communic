<?php

//Poniżej napisz kod łączący się z bazą danych

include_once __DIR__ . '/../rest/config/db.php';

$response = [];
//connect to DB
try {
    $conn = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_DB.";charset=utf8"
        , DB_LOGIN, DB_PASSWORD,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    $response = ['error' => 'DB Connection error: '.$e->getMessage()];
}

?>