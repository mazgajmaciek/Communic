<?php

include_once '../../bootstrap.php';
header('Content-Type: application/json');//return json header

$_SESSION['logged'] = false;

$response = ['loggedout' => 'success'];
echo json_encode($response);
?>