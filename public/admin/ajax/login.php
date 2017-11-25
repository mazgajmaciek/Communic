<?php
include_once '../../bootstrap.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = User::showUserByEmail($connection, $email);
    if ($user) {
        if (password_verify($password, $user->getHashPassword()) === TRUE) {
            $_SESSION['logged'] = true;
            $_SESSION['userId'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();

            echo $response = ['success' => json_encode('login successful', JSON_PRETTY_PRINT)];
        } else {
            echo $response = ['error' => json_encode('wrong password', JSON_PRETTY_PRINT)];
        }
    } else {
        echo $response = ['error' => json_encode("user doesn't exist", JSON_PRETTY_PRINT)];
    }
} else {
    echo $response = ['error' => json_encode("Data not sent via POST or login/password not set", JSON_PRETTY_PRINT)];
}
?>
