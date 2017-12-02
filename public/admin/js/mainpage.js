$(function () {

    //show username of currently logged in user
    var $navbarUsername = $("#navbarUsername");
    $($navbarUsername).load("../admin/ajax/mainpage.php", function() {

        $.ajax({
            url: "../admin/ajax/mainpage.php",
            dataType: 'json'
        })
            .done(function (response) {
                $navbarUsername.html("Welcome, " + response.success);
                console.log(response.tweets);

                for(var i = 0; i < response.tweets.length; i++) {
                    var obj = response.tweets[i];

                    console.log(obj.text);
                }

            })
            .fail(function (response) {
                console.log(response);
            });

    });


    //logout to login page
    $('#logoutBtn').on('click', function (event) {
        event.preventDefault();

        $.ajax({
            url: "logout.php",
            dataType: 'json'
        })
            .done(function (response) {
                console.log(response);

                if(response.loggedout){
                    //alert dropdown here

                    setTimeout(window.location.replace("login.html"),2000);
                } else {
                    alert('something went no yes');
                    return false;
                }
            })
            .fail(function (response) {
                console.log(JSON.stringify(response.error));
            });
    });

    //send new message
    var $newMsgBtn = $('#newMsgBtn');

    $($newMsgBtn).on('click', function (event) {
        event.preventDefault();

        // var that = $(this),
        //     url = that.attr('action'),
        //     type = that.attr('method'),
        //     data = {};
        //
        // that.find('[name]').each(function () {
        //
        //     var that = $(this),
        //         name = that.attr('name'),
        //         value = that.val();
        //
        //     data[name] = value;
        // });
        //
        // $.ajax({
        //     url: url,
        //     type: type,
        //     data: data,
        //     dataType: 'json'
        // })
        //     .done(function (response) {
        //         console.log(response);
        //
        //         var $loginResult = $("#loginResult");
        //
        //         if(response.success){
        //             var $msg = `<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> ${response.success} </div>`;
        //
        //             $loginResult.html($msg);
        //             $loginResult.slideToggle().delay(500);
        //
        //             setTimeout(' window.location.href = "mainpage.html"; ',500);
        //         } else {
        //             var msg = `<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${response.error} </div>`;
        //             $loginResult.html(msg);
        //             $loginResult.slideDown().delay(500);
        //             $loginResult.slideUp().delay(500);
        //
        //             return false;
        //         }
        //     })
        //     .fail(function (response) {
        //         console.log(response.error);
        //     });
    });


});