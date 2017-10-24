<?php
include_once '../bootstrap.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) !== FALSE) {
            //var_dump($_POST);


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
                header("refresh:3;url=mainpage.php");
                echo "Użytkownik zarejestrowany. Nastąpi przekierowanie na stronę główną";
            } else {
                echo 'Użytkownik o podanym adresie email juz istnieje w systemie!';
            }
        } else {
            echo "Format adresu email jest niepoprawny. Spróbuj ponownie";
        }
    } else {
        echo "Nie podano wszystkich wymaganych danych do rejestracji. Spróbuj ponownie.";
    }


    //http://stackoverflow.com/questions/35131149/check-email-to-be-unique-php
}
?>
<h2>Zarejestruj sie:</h2>
<form method="post">

    Nazwa uzytkownika: <input name="username">
    <br>
    Email: <input name="email">
    <br>
    Haslo: <input name="password" type="password">
    <br>
    <button type="submit">Zarejestruj</button>
</form>
