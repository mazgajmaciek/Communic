$(function () {

    $('form.form-login').on('submit', function (event) {
        event.preventDefault();

        var that = $(this),
            url = that.attr('action'),
            type = that.attr('method'),
            data = {};

        that.find('[name]').each(function () {

            var that = $(this),
                name = that.attr('name'),
                value = that.val();

            data[name] = value;
        });

        $.ajax({
            url: url,
            type: type,
            data: data,
            dataType: 'json'
            })
            .done(function (response) {
                console.log(response);

                var $loginResult = $("#loginResult");
                var that = $(this);

                if(response.success){
                    var msg = `<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> ${response.success} </div>`;
                    $loginResult.html(msg);
                    $loginResult.slideToggle().delay(500);

                    setTimeout(' window.location.href = "mainpage.html"; ',500);
                    return false;
                } else {
                    var msg = `<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${response.error} </div>`;
                    $loginResult.html(msg);
                    $loginResult.slideDown().delay(500);
                    $loginResult.slideUp().delay(500);
                    //$loginResult.hide();


                    // $loginResult.add('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>   '+response.error+'</div>');
                    // $loginResult.show();
                    // $loginResult.delay(1000).fadeOut("normal", function() {
                    //
                    // });
                    // this.remove();
                    return false;
                }
            })
            .fail(function (response) {
            console.log(response.error);
            });


    });


});

    // $('body').on('submit', '#modalRegister', function (element) {
    //     element.preventDefault();
    //
    //
    //     var $username = $('#modalRegister').find('#username').val();
    //     alert($username);
    //
    // });