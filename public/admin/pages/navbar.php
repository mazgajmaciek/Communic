<?php
include_once '../../bootstrap.php';
header('Content-Type: application/json');//return json header

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = User::showUserByEmail($conn, $email);
    if ($user) {
        if (password_verify($password, $user->getHashPassword()) === TRUE) {
            $_SESSION['logged'] = true;
            $_SESSION['userId'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $username = $_SESSION['username'];


            $response = ['success' => 'login successful',
                        'username' => $username];
            echo json_encode($response);

        } else {
            $response = ['error' => 'wrong password'];
            echo json_encode($response);
        }
    } else {
        $response = ['error' => "user doesn't exist"];
        echo json_encode($response);
    }
} else {
    $response = ['error' => "Data not sent via POST or login/password not set"];
    echo json_encode($response);
}
?>
