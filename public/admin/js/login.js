
$(function () {

    $('form.form-login').on('submit', function () {

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
            })
            .done(function (response) {
                console.log(response);

                if(response.success){
                    alert('login successful');
                    setTimeout(' window.location.href = "mainpage.php"; ',2000);

                } else {
                    alert(response.error);
                    $("#loginResult").fadeIn(1000, function(){
                        $("#loginResult").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>   '+response.error+'</div>');
                    });
                }
            })
            .fail(function (error) {
            console.log(JSON.stringify(error));
            });


        // to prevent submitting the form in traditional fashion
        return false;
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