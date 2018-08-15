<?php
session_start();

header('Content-Type: application/json');//return json header
$userId = $_SESSION['userId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['newEmail']) && !empty($_POST['newEmail'])) {
        $newEmail = $_POST['newEmail'];


        $loggedUser = User::loadUserById($conn, $userId);
        $loggedUser->setEmail($newEmail);
        $loggedUser->save($conn);

        $newEmailArray = [];
        $newEmailArray[] = json_decode(json_encode($newEmail), true);

        $response = ['success' => $newEmailArray,
            'message' => "Email address updated"];

    } elseif (isset($_POST['newUsername']) && !empty($_POST['newUsername'])) {
        $newUsername = $_POST['newUsername'];

        $loggedUser = User::loadUserById($conn, $userId);
        $loggedUser->setUsername($newUsername);
        $loggedUser->save($conn);

        $_SESSION['username'] = $newUsername;


        echo "Twoja nazwa użytkownika została zmieniona!";
    } elseif (isset($_POST['newPassword']) && !empty($_POST['newPassword'])) {
        $newPassword = $_POST['newPassword'];

        $loggedUser = User::loadUserById($conn, $userId);
        $loggedUser->setHashPassword($newPassword);
        $loggedUser->save($conn);

        echo "Twoje hasło zostało zmienione!";
    } else {
        //json response error
    }
} else {
    echo "not post";
}