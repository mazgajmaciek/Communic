$(function () {

	// $('#container').load("../mainpage.html");

	var $mainpage = $('#mainpage');

	$mainpage.on('submit', function (event) {
		event.preventDefault();

	});






	//show username of currently logged in user
	// $($navbarUsername).load("../pages/mainpage.php", function () {
	//
	// 	$.ajax({
	// 		url: "../pages/mainpage.php",
	// 		dataType: 'json'
	// 	})
	// 		.done(function (response) {
	// 			$navbarUsername.html("Welcome, " + response.username);
	// 			console.log(response.tweets);
	//
	// 			var $tweetPanel = $('#tweetPanel');
	//
	// 			if (response.tweets.length > 0) {
	// 				$.each(response.tweets, function (index, value) {
	// 					renderTweet(value);
	// 				})
	//
	// 			} else {
	// 				$tweetPanel.find('.panel-body').html("No tweets");
	// 			}
	//
	//
	// 		})
	// 		.fail(function (response) {
	// 			console.log(response);
	// 		});
	//
	// });

		//logout to login page
		$('#logoutBtn').on('click', function (event) {
			event.preventDefault();

			$.ajax({
				url: "logout.php",
				dataType: 'json'
			})
				.done(function (response) {
					console.log(response);

					if (response.loggedout) {
						//alert dropdown here

						setTimeout(window.location.replace("../login.html"), 2000);
					} else {
						alert('something went no yes');
						return false;
					}
				})
				.fail(function (response) {
					console.log(JSON.stringify(response.error));
				});
		});

});