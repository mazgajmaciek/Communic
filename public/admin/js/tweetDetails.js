$(function () {

	alert("js loaded");
	var $dupa = $('#dupa');

	$dupa.on('mouseenter', function (event) {
		event.preventDefault();
		alert("dupa alert");
	})

	$('#privateMsgLink').on('click', function (event) {
		event.preventDefault();
		alert("bang");

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
	});

}

