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

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Communic - Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="page-bg"></div>

<div class="container form-signin">
    <div class="panel panel-info">
        <div class="panel-body h4">
            Logowanie
        </div>
        <div class="panel-footer">
            <form class="form-signin" method="post">
                <?php echo join('<br>', $errors); ?>
                <label for="inputEmail" class="sr-only">Adres Email</label>
                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only">Hasło</label>
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <!--        <div class="checkbox">-->
                <!--            <label>-->
                <!--                <input type="checkbox" value="remember-me"> Remember me-->
                <!--            </label>-->
                <!--        </div>-->
                <button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj</button>
            </form>
        </div>
    </div>
</div> <!-- /container -->

<!--<div class="container jumbotron rounded" style="width: 20rem;">-->
<!--    <img class="card-img-top" src="" alt="Card image cap">-->
<!--    <div class="card-body">-->
<!--        <h4 class="card-title">Rejestracja</h4>-->
<!--        <p class="card-text">Jesteś nowy? Zarejestruj się!</p>-->
<!--        <a href="register.php" class="btn btn-primary">Zarejestruj się</a>-->
<!--    </div>-->
<!--</div>-->
<!---->
<div class="container form-signin">
    <div class="panel panel-info">
        <div class="panel-body h4">
            Jesteś nowy? Zarejestruj się!
        </div>
        <div class="panel-footer">
            <form class="form-signin">
                <!--        <div class="checkbox">-->
                <!--            <label>-->
                <!--                <input type="checkbox" value="remember-me"> Remember me-->
                <!--            </label>-->
                <!--        </div>-->
<!--                <a href="register.php" class="btn btn-lg btn-primary btn-block" type="submit">Rejestracja</a>-->

                <button type="button" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#register">
                    Rejestracja
                </button>
            </form>
        </div>
    </div>
</div> <!-- /container -->

<!-- Modal -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
