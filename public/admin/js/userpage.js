$(function () {

	function getUsername() {

		$.ajax({
			url: '../../../rest/rest.php/userpage',
			type: 'GET'
		})
			.done(function (response) {
				console.log(response);

				var $username = $('#username');
				$username.append(response.username);

				// var $statusChange = $("#emailChange");
				// var delay = 500;
				//
				// if(response.success){
				// 	var $msg = `<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> ${response.message} </div>`;
				//
				// 	$statusChange.html($msg);
				// 	$statusChange.slideDown().delay(delay);
				// 	$statusChange.slideUp().delay(delay);
				//
				// } else {
				// 	var msg = `<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${response.message} </div>`;
				// 	$statusChange.html(msg);
				// 	$statusChange.slideDown().delay(delay);
				// 	$statusChange.slideUp().delay(delay);
				//
				// 	return false;
				// }
			})
			.fail(function (response) {
				console.log(response);
			});
	}

	getUsername();



	// $('body').on('submit', '#authorEdit', function (element) {
	//
	// 	element.preventDefault();
	// 	var id = $(this).find('#id').val();
	//
	// 	console.log(id);
	//
	// 	var userName = $authorEditForm.find('#name').val();
	// 	var authorSurname = $authorEditForm.find('#surname').val();
	// 	var authorDesc = $authorEditForm.find('#description').val();
	//
	//
	// 	var editedAuthor = {
	// 		name: authorName,
	// 		surname: authorSurname,
	// 		description: authorDesc
	// 	};
	//
	// 	console.log('Ajax');
	// 	//ajax query - edits book title and/or description in db
	// 	$.ajax({
	// 		url: '../rest/rest.php/author/' + id,
	// 		type: 'PATCH',
	// 		data: editedAuthor
	// 	})
	// 		.done(function (response) {
	// 			console.log('done, author id: ' + id + " edited in db");
	// 			$authorEditForm.slideUp();
	//
	// 			//here should edit the relevant id in books list
	// 			console.log(id);
	// 			//updates relevant existing book list title
	// 			var $authorList = $('[class="authorTitle"][data-id=' + id + ']');
	// 			$authorList.text(response.success[0].name + response.success[0].surname);
	//
	//
	// 		})
	// 		.fail(function (error) {
	// 			console.log('Fail');
	// 			console.log('Edit book error', error);
	// 			console.log(JSON.stringify(error));
	// 		});
	//
	// })

});