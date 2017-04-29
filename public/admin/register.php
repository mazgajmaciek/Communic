<?php
include_once '../bootstrap.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        var_dump($_POST);


        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        
        
    } else {
        echo "Nie podano wszystkich wymaganych danych do rejestracji. Spróbuj ponownie.";
    }


    //http://stackoverflow.com/questions/35131149/check-email-to-be-unique-php
} else {
    echo "Nie przeslano danych do rejestracji";
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
