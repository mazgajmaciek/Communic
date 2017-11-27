$(function () {

    $('#logoutBtn').on('click', function (event) {
        event.preventDefault();

        var that = $(this),
            data = {};

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
                console.log(JSON.stringify(response));
            });
    });


});