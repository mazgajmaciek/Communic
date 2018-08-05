<?php
session_start();

header('Content-Type: application/json');//return json header

$userId = $_SESSION['userId'];

if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    if (isset($_POST['email_change']) && !empty($_POST['email_change'])) {
        $newEmail = $_POST['email_change'];

        $loggedUser = User::loadUserById($conn, $userId);
        $loggedUser->setEmail($newEmail);
        $loggedUser->save($conn);

        echo "Twój adres email został zmieniony!";
    } elseif (isset($_POST['username_change']) && !empty($_POST['username_change'])) {
        $newUsername = $_POST['username_change'];

        $loggedUser = User::loadUserById($conn, $userId);
        $loggedUser->setUsername($newUsername);
        $loggedUser->save($conn);

        $_SESSION['username'] = $newUsername;


        echo "Twoja nazwa użytkownika została zmieniona!";
    } elseif (isset($_POST['password_change']) && !empty($_POST['password_change'])) {
        $newPassword = $_POST['password_change'];

        $loggedUser = User::loadUserById($conn, $userId);
        $loggedUser->setHashPassword($newPassword);
        $loggedUser->save($conn);

        echo "Twoje hasło zostało zmienione!";
    } else {
        //json response error
    }
}