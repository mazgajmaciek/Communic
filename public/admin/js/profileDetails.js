$(function () {

	var that = $(this);

	$('#privateMsgLink').on('submit', function (event) {
		event.preventDefault();
		alert("js bang");

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

});
