$(function () {

	var $formNewEmail = $('form.form-new-email');
	var $formNewUsername = $('form.form-new-username');
	var $formNewPassword = $('form.form-new-password');

	$formNewEmail.on('submit', function (event) {
		event.preventDefault();

		var that = $(this),
			type = that.attr('method'),
			data = {};

		that.find('[name]').each(function () {

			var that = $(this),
				name = that.attr('name'),
				value = that.val();

			data[name] = value;
		});

		$.ajax({
			url: '../../../rest/rest.php/profiledetails',
			type: type,
			data: data,
			dataType: 'json'
		})
			.done(function (response) {
				console.log(response);

				var $statusChange = $("#emailChange");
				var delay = 500;

				if(response.success){
					var $msg = `<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> ${response.message} </div>`;

					$statusChange.html($msg);
					$statusChange.slideDown().delay(delay);
					$statusChange.slideUp().delay(delay);

				} else {

					var msg = `<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${response.message} </div>`;
					$statusChange.html(msg);
					$statusChange.slideDown().delay(delay);
					$statusChange.slideUp().delay(delay);

					return false;
				}
			})
			.fail(function (response) {
				console.log(response);
			});
	});

	$formNewUsername.on('submit', function (event) {
		event.preventDefault();

		var that = $(this),
			type = that.attr('method'),
			data = {};

		that.find('[name]').each(function () {

			var that = $(this),
				name = that.attr('name'),
				value = that.val();

			data[name] = value;
		});

		$.ajax({
			url: '../../../rest/rest.php/profiledetails',
			type: type,
			data: data,
			dataType: 'json'
		})
			.done(function (response) {
				console.log(response);

				var $statusChange = $("#usernameChange");
				var delay = 500;

				if(response.success){
					var $msg = `<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> ${response.message} </div>`;

					$statusChange.html($msg);
					$statusChange.slideDown().delay(delay);
					$statusChange.slideUp().delay(delay);

				} else {
					var msg = `<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${response.message} </div>`;
					$statusChange.html(msg);
					$statusChange.slideDown().delay(delay);
					$statusChange.slideUp().delay(delay);

					return false;
				}
			})
			.fail(function (response) {
				console.log(response);
			});
	});

	$formNewPassword.on('submit', function (event) {
		event.preventDefault();

		var that = $(this),
			type = that.attr('method'),
			data = {};

		that.find('[name]').each(function () {

			var that = $(this),
				name = that.attr('name'),
				value = that.val();

			data[name] = value;
		});

		$.ajax({
			url: '../../../rest/rest.php/profiledetails',
			type: type,
			data: data,
			dataType: 'json'
		})
			.done(function (response) {
				console.log(response);

				var $statusChange = $("#passwordChange");
				var delay = 500;

				if(response.success){
					var $msg = `<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> ${response.success} </div>`;

					$statusChange.html($msg);
					$statusChange.slideDown().delay(delay);
					$statusChange.slideUp().delay(delay);

				} else {
					var msg = `<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${response.message} </div>`;
					$statusChange.html(msg);
					$statusChange.slideDown().delay(delay);
					$statusChange.slideUp().delay(delay);

					return false;
				}
			})
			.fail(function (response) {
				console.log(response);
			});
	});



});
