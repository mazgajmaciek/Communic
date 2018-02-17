<?php
include_once '../../bootstrap.php';
header('Content-Type: application/json');//return json header


if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $connection->prepare('SELECT COUNT(email) As `emailCount` FROM Users WHERE email = :email');
    $stmt->execute([
        'email' => $_POST['email']
    ]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['emailCount'] == 0) {
        $user = new User();

        $user->setEmail($email);
        $user->setUsername($username);
        $user->setHashPassword($password);

        $result = $user->save($connection);

        $_SESSION['logged'] = true;

        $response = ['success' => 'You have registered!'];
        echo json_encode($response);
    } else {
        $response = ['error' => 'Email already registered!'];
        echo json_encode($response);
    }
} else {
    $response = ['error' => 'Please complete all fields'];
    echo json_encode($response);

}


//http://stackoverflow.com/questions/35131149/check-email-to-be-unique-php

?>
