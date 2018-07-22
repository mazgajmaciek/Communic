<?php

include_once '../bootstrap.php';

$user = User::loadUserById($conn, 13);
$user->setEmail('mazgaj3@tlen.pl');
$user->setHashPassword('haslohaslo');
$user->setUsername('mazgaj2');


$result = $user->save($conn);

