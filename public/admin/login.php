<?php
include_once '../bootstrap.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = User::showUserByEmail($connection, $email);
    if ($user) {
        if (/* $user->getHashPassword() */ password_verify($password, $user->getHashPassword()) === TRUE) {
            $_SESSION['logged'] = true;
            $_SESSION['userId'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();

            header( "refresh:3;url=mainpage.php" );
            echo "Uzytkownik zalogowany. Nastapi przekierowanie na strone glowna";
            
        } else {
            $errors[] = 'Hasło niepoprawne';
        }
    } else {
        $errors[] = 'Brak takiego użytkownika';
    }
} else {

}
?>
<html>
    <body>
        <h2>Zaloguj sie</h2>
        <form method="post">
            <?php echo join('<br>', $errors); ?>
            <br>
            Email: <input name="email">
            <br>
            Haslo: <input name="password" type="password">
            <br>
            <button type="submit">Loguj</button>
            
            
            <h2>Jestes nowy? Zarejestruj sie <a href="register.php">tutaj</a></h2>
            
            
        </form>
    </body>
</html>