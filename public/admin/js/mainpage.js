$(function () {

	var $newTweetForm = $(".tweet-new");
	var $tweetList = $('#tweetList');

	//renders all existing tweets
	function getMainPageTweets() {
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
	};

	//render tweet function
	function renderTweet(tweet) {
		var string = `<div class="panel panel-default">
						  <div class="panel-heading">
						        <div class="split-para">
						            <a data-userid=${tweet.userId} href="../pages/userpage.php?user=${tweet.userId}">
						            	<b>${tweet.userName}</b>
						            </a>
						            <span>${tweet.creationDate}</span>
						        </div>
						  </div>
						  <div class="panel-body">${tweet.text}</div>
						</div>`;

		$tweetList.append(string);
	}


	//send new tweet
	//TODO - complete the below
	$($newTweetForm).on('submit', function (event) {
		event.preventDefault();

		var that = $(this),
			url = that.attr('action'),
			type = that.attr('method'),
			data = {};

		// var text = $('#new-tweet-textarea').val();


			// var newTweet = {
			// 	text: text,
			//
			// };

		that.find('[name]').each(function () {

			var that = $(this),
				name = that.attr('name'),
				value = that.val();

			data[name] = value;
		});



		$.ajax({
			url: "../../../rest/rest.php/tweet",
			dataType: 'JSON',
			type: type,
			data: data
		})
			.done(function (response) {

				var $newTweetNotice = $("#tweet-textarea-notice");
				var $textArea = $("textarea[name='new_message_text']");

				if (response.newTweet) {
					console.log(response);
					prependNewTweet(response.newTweet);
					//clears new tweet textarea
					$textArea.val('');
				}

			})
			.fail(function (response) {
				console.log(response);

				var $newTweetNotice = $("#tweet-textarea-notice");
				var msg = `<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> ${response.responseJSON.error} </div>`;

				$newTweetNotice.html(msg);
				$newTweetNotice.slideDown().delay(500);
				$newTweetNotice.slideUp().delay(500);

				return false;
			});

	});

	//append new tweet to the top of the list
	function prependNewTweet(newTweet) {
		var string = `<div class="panel panel-default">
						  <div class="panel-heading">
						        <div class="split-para">
						        	<a data-userid=${newTweet.userId} href="../pages/userpage.php?user=${newTweet.userId}">
						            	<b>${newTweet.userName}</b>
						            </a>
						            <span>${newTweet.creationDate}</span></div>
						  </div>
						  <div class="panel-body">${newTweet.text}</div>
						</div>`;

		$tweetList.prepend(string);
	}

	getMainPageTweets();

});

