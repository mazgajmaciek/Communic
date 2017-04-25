<?php

include_once '../bootstrap.php';

$user = User::loadUserById($connection, 13);
$user->setEmail('mazgaj2@tlen.pl');
$user->setHashPassword('haslohaslo');

$result = $user->save($connection);

