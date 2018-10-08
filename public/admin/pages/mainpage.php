<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Communic - Main Page</title>

    <!-- Bootstrap -->
<!--    <link href="../css/bootstrap.min.css" rel="stylesheet">-->
<!--    <link href="../css/mainpage.css" rel="stylesheet">-->

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<!--    <link rel="stylesheet" href="../css/bootstrap.min.css">-->
    <link href="../css/mainpage.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<!--page background-->
<div class="page-bg"></div>

<!--new message panel-->
<form class="tweet-new" method="post" action="">
    <div class="panel panel-default panel-primary tweet-newmessage">
        <div class="panel-heading">
            <h3 class="panel-title"><b>New message:</b></h3>
        </div>
        <div class="panel-body">
            <textarea id="new-tweet-textarea" class="form-control" name="new_message_text" placeholder="max 140 characters" maxlength="140"></textarea>
            <div id="tweet-textarea-notice" style="display: none"></div>
        </div>
        <div class="panel-footer">
            <button type="submit" id="newMsgBtn" class="btn btn-primary pull-right">Send</button>
        </div>
    </div>
</form>

<!--tweet ul list, added dynamically in mainpage.js-->
<ul class="list-group list-tweet" id="tweetList">
    <!--<div class="panel panel-default">-->
    <!--<div class="panel-heading">${tweet.userName}</div>-->
    <!--<div class="panel-body">${tweet.text}</div>-->
    <!--</div>-->
</ul>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>