<?php
include_once '../../bootstrap.php';
?>

<!--<h2><a href="mainpage.php">Powrót do strony głównej</a></h2>-->
<!---->
<!--    <a href="../privateMessages.php"><h3>Przejdź do prywatnych wiadomości</h3></a>-->

<h2>Zmień swój adres email:</h2>

<form method="post">
    Podaj swój nowy adres email:
    <input type="text" name="email_change">
    <input type="submit">
</form>

<?php
$userId = $_SESSION['userId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email_change']) && !empty($_POST['email_change'])) {
        $newEmail = $_POST['email_change'];

        $loggedUser = User::loadUserById($conn, $userId);
        $loggedUser->setEmail($newEmail);
        $loggedUser->save($conn);

        echo "Twój adres email został zmieniony!";
    }
}
?>

<h2>Zmień swoją nazwę użytkownika:</h2>

<form method="post">
    Podaj swoją nową nazwę użytkownika:
    <input type="text" name="username_change">
    <input type="submit">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username_change']) && !empty($_POST['username_change'])) {
        $newUsername = $_POST['username_change'];

        $loggedUser = User::loadUserById($conn, $userId);
        $loggedUser->setUsername($newUsername);
        $loggedUser->save($conn);

        $_SESSION['username'] = $newUsername;


        echo "Twoja nazwa użytkownika została zmieniona!";
    }
}
?>

<h2>Zmień swoje hasło:</h2>

<form method="post">
    Podaj swoje nowe hasło:
    <input type="password" name="password_change">
    <input type="submit">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password_change']) && !empty($_POST['password_change'])) {
        $newPassword = $_POST['password_change'];

        $loggedUser = User::loadUserById($conn, $userId);
        $loggedUser->setHashPassword($newPassword);
        $loggedUser->save($conn);

        echo "Twoje hasło zostało zmienione!";
    }
}
?>