$(function () {

	var $newTweetForm = $(".tweet-new");
	var $tweetList = $('#tweetList');
	var $navbarUsername = $("#navbarUsername");

	//show username of currently logged in user
	$($navbarUsername).load("../admin/ajax/mainpage.php", function () {

		$.ajax({
			url: "../admin/ajax/mainpage.php",
			dataType: 'json'
		})
			.done(function (response) {
				$navbarUsername.html("Welcome, " + response.username);
				console.log(response.tweets);

				var $tweetPanel = $('#tweetPanel');

				if (response.tweets.length > 0) {
					$.each(response.tweets, function (index, value) {
						renderTweet(value);
					})

				} else {
					$tweetPanel.find('.panel-body').html("No tweets");
				}


			})
			.fail(function (response) {
				console.log(response);
			});

	});

	//render post function
	function renderTweet(tweet) {
		var string = `<div class="panel panel-default">
						  <div class="panel-heading">
						        <div class="split-para">
						            <b>${tweet.userName}</b>
						            <span>${tweet.creationDate}</span></div>
						  </div>
						  <div class="panel-body">${tweet.text}</div>
						</div>`;

		$tweetList.append(string);
	}

	//append new tweet to the top of the list
	function prependNewTweet(tweet) {
		var string = `<div class="panel panel-default">
						  <div class="panel-heading">
						        <div class="split-para">
						            <b>${tweet.userName}</b>
						            <span>${tweet.creationDate}</span></div>
						  </div>
						  <div class="panel-body">${tweet.text}</div>
						</div>`;

		$tweetList.prepend(string);
	}


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

					setTimeout(window.location.replace("login.html"), 2000);
				} else {
					alert('something went no yes');
					return false;
				}
			})
			.fail(function (response) {
				console.log(JSON.stringify(response.error));
			});
	});

	//send new tweet
	$($newTweetForm).on('submit', function (event) {
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
			dataType: 'json',
			type: type,
			data: data
		})
			.done(function (response) {

				var $panelFooterNotice = $(".tweet-newmessage");
				var $textArea = $("textarea[name='new_message_text']");
				console.log(response);

				if (response.newTweet) {
					prependNewTweet(response.newTweet);
					$textArea.val('');
				} else {
					var msg = `<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${response.error} </div>`;
					$panelFooterNotice.append(msg);
					$panelFooterNotice.find(".alert alert-danger").fadeOut(300, function () {
						var that = $(this);
							that.remove();
					});

					return false;
				}

			})
			.fail(function (response) {
				console.log(response.error);
			});

	});


});