<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Communic</title>
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

<!--navigation bar-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <a id="mainpage" class="navbar-brand" href="?action=mainpage">Communic</a>
                    <li><a id="profiledetails" href="?action=profileDetails">Profile</a></li>
                    <li><a id="userpage" href="?action=userpage">User Page</a></li>
                    <li><a id="privateMessage" href="?action=privateMessage">Private Messages</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
        <button type="button" class="btn btn-primary navbar-btn navbar-right btn-logout" id="logoutBtn">Log Out</button>
    </div>
</nav>

<div class="container" id="container">
    <?php
    $action = '';

    //check if there is subpage request
    if (isset($_GET['action'])) {
        $action = preg_replace('#[^0-9a-zA-Z]#', '', $_GET['action']);//clean all non alfanum chars from action for safety
        $incFile = __DIR__.'/'.$action.'.php';//define variable with subpage path
        include_once $incFile;//load subpage file
    }
    ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../js/index.js"></script>
<?php
//check if there is subpage request
if ($action) {
    echo '<script src="../js/'.$action.'.js"></script>';//load js file for subbage
}
?>
</body>
</html>