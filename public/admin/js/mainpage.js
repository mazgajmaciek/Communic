$(function () {

	var $newTweetForm = $(".tweet-new");
	var $tweetList = $('#tweetList');

		$.ajax({
			url: "../../../rest/rest.php/tweet",
			dataType: 'json',
			type: 'GET'
		})
			.done(function (response) {

				console.log(response);

				var $tweetPanel = $('#tweetPanel');

				if (response.tweets.length > 0) {

					$.each(response.tweets, function (index, tweet) {
						renderTweet(tweet);
					})

				} else {
					$tweetPanel.find('.panel-body').html("No tweets");
				}


			})
			.fail(function (response) {

				console.log(response.responseText);
			});


	//render tweet function
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
	function prependNewTweet(tweets) {
		var string = `<div class="panel panel-default">
						  <div class="panel-heading">
						        <div class="split-para">
						            <b>${tweets.username}</b>
						            <span>${tweets.newTweet.creationDate}</span></div>
						  </div>
						  <div class="panel-body">${tweets.newTweet.text}</div>
						</div>`;

		$tweetList.prepend(string);
	}




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
			url: "../../../rest/rest.php/tweet",
			//TODO - ajax url is pointing to form's action attribute in mainpage.php, this is why ajax request is returning the whole page - this has to be modified
			dataType: 'json',
			type: type,
			data: data
		})
			.done(function (response) {

				console.log(response);

				var $newTweetNotice = $("#tweet-textarea-notice");
				var $textArea = $("textarea[name='new_message_text']");

				if (response.newTweet) {
					console.log(response);
					prependNewTweet(response);
					//clears new tweet textarea
					$textArea.val('');
				} else {
					var msg = `<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${response.error} </div>`;

					$newTweetNotice.html(msg);
					$newTweetNotice.slideDown().delay(500);
					$newTweetNotice.slideUp().delay(500);

					return false;
				}

			})
			.fail(function (response) {
				console.log(response);
			});

	});


});