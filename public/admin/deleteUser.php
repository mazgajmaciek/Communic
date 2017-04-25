<?php

include_once '../bootstrap.php';

$user = User::loadUserById($connection, 13);
$user->delete($connection);

