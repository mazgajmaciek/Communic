$(function () {

	$('body').on('submit', '#authorEdit', function (element) {

		element.preventDefault();
		var id = $(this).find('#id').val();

		console.log(id);

		var userName = $authorEditForm.find('#name').val();
		var authorSurname = $authorEditForm.find('#surname').val();
		var authorDesc = $authorEditForm.find('#description').val();


		var editedAuthor = {
			name: authorName,
			surname: authorSurname,
			description: authorDesc
		};

		console.log('Ajax');
		//ajax query - edits book title and/or description in db
		$.ajax({
			url: '../rest/rest.php/author/' + id,
			type: 'PATCH',
			data: editedAuthor
		})
			.done(function (response) {
				console.log('done, author id: ' + id + " edited in db");
				$authorEditForm.slideUp();

				//here should edit the relevant id in books list
				console.log(id);
				//updates relevant existing book list title
				var $authorList = $('[class="authorTitle"][data-id=' + id + ']');
				$authorList.text(response.success[0].name + response.success[0].surname);


			})
			.fail(function (error) {
				console.log('Fail');
				console.log('Edit book error', error);
				console.log(JSON.stringify(error));
			});

	})

	function printUsername(response) {
		$string = "    <h3>Wyślij prywatną wiadomość:</h3>\n" +
			"\n" +
			"    <form method=\"post\" action=\"#\">\n" +
			"        Twoja wiadomosc <input name=\"private_message\" placeholder=\"Max 140 znaków\" maxlength=\"140\">\n" +
			"        <br>\n" +
			"        <button type=\"submit\">Wyslij</button>\n" +
			"        <br>\n" +
			"        <br>\n" +
			"    </form>";
	}

});