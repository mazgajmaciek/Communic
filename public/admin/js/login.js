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

                if(response.success){
                    var $msg = `<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> ${response.success} </div>`;

                    $loginResult.html($msg);
                    $loginResult.slideToggle().delay(500);

	                var delay = 500;
                    // setTimeout('window.location.href = "../public/admin/pages/index.php";', delay);
                    // setTimeout('window.location.href = "../public/admin/pages/mainpage.php";', delay);
	                setTimeout('window.location.replace("../public/admin/pages/index.php")', delay);
                    //window.location.replace("../public/admin/pages/mainpage.php");

                } else {
                    var msg = `<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${response.error} </div>`;
                    $loginResult.html(msg);
                    $loginResult.slideDown().delay(500);
                    $loginResult.slideUp().delay(500);

                    return false;
                }
            })
	        .fail(function (response) {
		        console.log(response);
	        });
    });

    var $registerPopup = $("#registerPopup");

    $registerPopup.on('submit', function (event) {
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

                var $regResult = $("#regResult");

                if(response.success){
                    var msg = `<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> ${response.success} </div>`;
                    $regResult.html(msg);
                    $regResult.slideToggle().delay(500);

	                var delay = 500;
	                var indexURL = '../admin/pages/index.php';
	                var mainpageURL = "../public/admin/pages/index.php";
	                setTimeout(function(){ window.location = indexURL; }, delay);
	                setTimeout(function(){ window.location = mainpageURL; }, delay);
                } else {
                    var msg = `<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${response.error} </div>`;
                    $regResult.html(msg);
                    $regResult.slideDown().delay(500);
                    $regResult.slideUp().delay(500);

                    return false;
                }
            })
            .fail(function (response) {
                console.log(response);
            });

    });




});