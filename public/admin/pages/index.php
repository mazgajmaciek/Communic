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
    session_start();
    /*
    The following function will strip the script name from URL
    i.e.  http://www.something.com/search/book/fitzgerald will become /search/book/fitzgerald
    */




//    function getCurrentUri()
//    {
//        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
//        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
//        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
//        $uri = '/' . trim($uri, '/');
//        return $uri;
//    }
//
//    $base_url = getCurrentUri();
//    $routes = array();
//    $routes = explode('/', $base_url);
//    foreach($routes as $route)
//    {
//        if(trim($route) != '')
//            array_push($routes, $route);
//    }
//
//    /*
//    Now, $routes will contain all the routes. $routes[0] will correspond to first route.
//    For e.g. in above example $routes[0] is search, $routes[1] is book and $routes[2] is fitzgerald
//    */
//
//    var_dump($routes);
//    var_dump($_SERVER["REQUEST_URI"]);
//    var_dump($_SERVER["REQUEST_URI"]);
//    var_dump($base_url);



//    if($routes[0] == "search")
//    {
//        if($routes[1] == "book")
//        {
//            searchBooksBy($routes[2]);
//        }
//    }
    $action = '';
    //check if there is subpage request
    if (isset($_GET['action'])) {
        $addArr = explode('/', $_GET['action']);

        if (count($addArr) > 1) {
            $_SESSION['userpageId'] = $addArr[1];
            $action = preg_replace('#[^0-9a-zA-Z]#', '', $addArr[0]);//clean all non alfanum chars from action for safety
            $incFile = __DIR__.'/'.$action. '.php';//define variable with subpage path

            include_once $incFile;//load subpage file
        } else {
            $action = preg_replace('#[^0-9a-zA-Z]#', '', $addArr[0]);//clean all non alfanum chars from action for safety
            $incFile = __DIR__.'/'.$action.'.php';//define variable with subpage path
            include_once $incFile;//load subpage file
        }
    }

//    if (isset($_GET['userid'])) {
//        $userIdURL = $_GET['userid'];
//        $action = preg_replace('#[^0-9a-zA-Z]#', '', $addArr[0]);//clean all non alfanum chars from action for safety
//        $incFile = __DIR__.'/'.$action.'.php';//define variable with subpage path
//        include_once $incFile;//load subpage file
//        $_SESSION['userIdUserpage'] = $userIdURL;
//    }



    //TODO - pass $addArr[1] via $_SESSION to Userpage.php endpoint + modifications of userpage.php depending on what userId is being
    //TODO - passed (part of the webpage must be loaded via .js

    ?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../js/index.js"></script>
<?php
//check if there is subpage request
if ($action) {
    echo '<script src="../js/'.$addArr[0].'.js"></script>';//load js file for subbage
    echo '<link rel="stylesheet" href="../../admin/jquery-ui-1.12.1.custom/jquery-ui.min.css">';
    echo '<script src="../../admin/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>';
    echo '<script src="../../admin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>';
}
?>
</body>
</html>