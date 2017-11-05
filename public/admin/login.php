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
<html lang="en">
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
            Login
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
                <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            </form>
        </div>
    </div>
</div> <!-- /container -->

<div class="container form-signin">
    <div class="panel panel-info">
        <div class="panel-body h4">
            No account? Register here!
        </div>
        <div class="panel-footer">
            <form class="form-signin">
                <button type="button" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#modalRegister">
                    Register
                </button>
            </form>
        </div>
    </div>
</div> <!-- /container -->

<!-- Registration popup Modal -->
<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Register</h4>
            </div>
            <div class="modal-body">
                <form class="form-signin" action='' method="POST">
                    <fieldset>
                        <div class="control-group">
                            <!-- Username -->
                            <label class="control-label" for="username">Username</label>
                            <div>
                                <input type="text" id="username" name="username" placeholder="Type in your username" class="form-control">
                                <p class="help-block">Username can contain any letters or numbers, without spaces</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <!-- E-mail -->
                            <label class="control-label" for="email">E-mail</label>
                            <div>
                                <input type="text" id="email" name="email" placeholder="Type in your email address" class="form-control">
                                <p class="help-block">Please provide your E-mail</p>
                            </div>
                        </div>

                        <div class="control-group">
                            <!-- Password-->
                            <label class="control-label" for="password">Password</label>
                            <div>
                                <input type="password" id="password" name="password" placeholder="Type in your password" class="form-control">
                                <p class="help-block">Please type in your password</p>
                            </div>
                        </div>
                    </fieldset>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-success">Send</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/register.js"></script>
</body>
</html>
