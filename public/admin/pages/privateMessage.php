<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Communic - Private Messages</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/mainpage.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
<!--page background-->
<div class="page-bg"></div>

<div class="row voffset5">
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div class="panel panel-primary">
            <div class="panel-heading">Send a private message</div>
            <div class="panel-body">
                <ul class="list-group" id="sendPrivateMessage">
                    <form class="form-user-search" id="userSearchForm" action="" method="post">
<!--                        <div class="form-group">-->
<!--                            <label for="userSearch">Find user</label>-->
<!--                            <input name="userSearch" id="userSearch" class="form-control" placeholder="Find user" autofocus>-->
<!--                            <input name="newPrvMessage" id="newPrvMessage" class="form-control" placeholder="Type in message" autofocus>-->
<!--                            <div id="userSearch" style="display:none;"></div>-->
<!---->
<!--                        </div>-->

                        <div class="form-group">
                            <label for="name">User Search</label>
                            <div class="autocomplete" style="width:300px;">
                                <input type="text" class="form-control" name="userSearch" id="userSearch" placeholder="Find user..." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="surname">Private Message</label>
                            <input type="text" class="form-control" name="newPrvMessage" id="newPrvMessage" placeholder="Type in private message..." required>
                        </div>

                        <button id="userSearchButton" type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i>&nbsp;Submit new private message</button>
                    </form>

                    </form>
                    <!--                    <li class="list-group-item">-->
                    <!--                        <div class="panel panel-default">-->
                    <!--                            <div class="panel-heading"><span class="authorTitle">Jan Kowalski</span>-->
                    <!--                                <button data-id="1" class="btn btn-danger pull-right btn-xs btn-author-remove"><i-->
                    <!--                                            class="fa fa-trash"></i></button>-->
                    <!--                                <button data-id="1" class="btn btn-primary pull-right btn-xs btn-author-books"><i-->
                    <!--                                            class="fa fa-book"></i></button>-->
                    <!--
                    <!--                            </div>-->
                    <!--                            <ul class="authorBooksList"></ul>-->
                    <!--                        </div>-->
                    <!--                    </li>-->

                </ul>
            </div>
        </div>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
</div>

<div class="row voffset5">
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div class="panel panel-primary">
            <div class="panel-heading">Received private messages</div>
            <div class="panel-body">
                <ul class="list-group" id="receivedMsgList">
                    <!--                    <li class="list-group-item">-->
                    <!--                        <div class="panel panel-default">-->
                    <!--                            <div class="panel-heading"><span class="authorTitle">Jan Kowalski</span>-->
                    <!--                                <button data-id="1" class="btn btn-danger pull-right btn-xs btn-author-remove"><i-->
                    <!--                                            class="fa fa-trash"></i></button>-->
                    <!--                                <button data-id="1" class="btn btn-primary pull-right btn-xs btn-author-books"><i-->
                    <!--                                            class="fa fa-book"></i></button>-->
                    <!--
                    <!--                            </div>-->
                    <!--                            <ul class="authorBooksList"></ul>-->
                    <!--                        </div>-->
                    <!--                    </li>-->

                </ul>
            </div>
        </div>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
</div>

<div class="row voffset5">
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <div class="panel panel-primary">
            <div class="panel-heading">Sent private messages</div>
            <div class="panel-body">
                <ul class="list-group" id="sentMsgList">
                    <!--                    <li class="list-group-item">-->
                    <!--                        <div class="panel panel-default">-->
                    <!--                            <div class="panel-heading"><span class="authorTitle">Jan Kowalski</span>-->
                    <!--                                <button data-id="1" class="btn btn-danger pull-right btn-xs btn-author-remove"><i-->
                    <!--                                            class="fa fa-trash"></i></button>-->
                    <!--                                <button data-id="1" class="btn btn-primary pull-right btn-xs btn-author-books"><i-->
                    <!--                                            class="fa fa-book"></i></button>-->
                    <!--
                    <!--                            </div>-->
                    <!--                            <ul class="authorBooksList"></ul>-->
                    <!--                        </div>-->
                    <!--                    </li>-->
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
</div>

<link rel="stylesheet" href="../../admin/jquery-ui-1.12.1.custom/jquery-ui.min.css">
<script src="../../admin/jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
<script src="../../admin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>