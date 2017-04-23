<?php

include_once '../connection.php';
include_once '../autoload.php';

//User::loadUserById($connection, 1);

var_dump(User::loadUserById($connection, 1));
