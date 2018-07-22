<?php

//include_once '../connection.php';
//include_once '../autoload.php';

include_once '../bootstrap.php';

if($_SERVER['REQUEST_METHOD'] === ['POST']) {
    var_dump($_POST);
    
}
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) {
    die('użytkownik musi być zalogowany');
}

$user = new User();
$user->setEmail('tt@tt.pl');
$user->setUsername('test');
$user->setHashPassword('password');

$result = $user->save($conn);
echo "Mamy usera";


$user2 = new User();
$user2->setEmail('mazgaj@mazgaj.pl');
$user2->setHashPassword('haslo');
$user2->setUsername('mazgaj1');

$result = $user2->save($conn);

