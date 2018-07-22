<?php

include_once '../bootstrap.php';

$user = User::loadUserById($conn, 13);
$user->delete($conn);