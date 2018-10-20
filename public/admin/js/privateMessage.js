$(function () {

	var $receivedMsgList = $("#receivedMsgList");
	var $sentMsgList = $("#sentMsgList");
	var $userSearchbox = $("#userSearch");
	var $input = $userSearchbox.val();

	function getReceivedPrivateMsg() {

		$
			.ajax({
				url: '../../../rest/rest.php/privateMessage',
				type: 'GET'
			})
			.done(function (response) {
				console.log(response.users);


				for (var i = 0; i < response.success.length; i++) {
					if (response.success[i].readStatus === "0") {
						renderNewReceivedPrivateMsg(response.success[i]);
					} else {
						renderReceivedPrivateMsg(response.success[i]);
					}
				}
			})
			.fail(function (error) {
				console.log('Create sent private message error', error);
			});
	}

	function getSentPrivateMsg() {
		$
			.ajax({
				url: '../../../rest/rest.php/privateMessage',
				type: 'GET'
			})
			.done(function (response) {
				for (var i = 0; i < response.sentPrvMsgs.length; i++) {
					renderSentPrivateMsg(response.sentPrvMsgs[i]);
				}
			})
			.fail(function (error) {
				console.log('Create author error', error);
			});
	}

	function renderReceivedPrivateMsg(receivedMsg) {
		var string = `<li class="list-group-item">
                <div class="panel-heading"> From:
                <span class="senderUserName" data-id="${receivedMsg.id}">${receivedMsg.userName}
                </span>
                <button data-id="${receivedMsg.id}" 
                class="btn btn-primary pull-right btn-xs btn-show-received-message">
                <li class="fa fa-info-circle"></li> Show message
                </button>
                </div>
                <div class="panel-body btn-show-message-details">                      
                </div>
                </li>`;

		$receivedMsgList.html($receivedMsgList.html() + string);
	}

	function renderNewReceivedPrivateMsg(receivedMsg) {
		var string = `<li class="list-group-item">
                <div class="panel-heading btn-warning"> From:
                <span class="senderUserNameNew" data-id="${receivedMsg.id}">${receivedMsg.userName}</span>
                <button data-id="${receivedMsg.id}" 
                class="btn btn-primary pull-right btn-xs btn-show-received-message">
                <li class="fa fa-info-circle"></li> Show message
                </button>
                </div>
                <div class="panel-body btn-show-message-details">                      
                </div>
                </li>`;

		$receivedMsgList.html($receivedMsgList.html() + string);
	}

	function renderSentPrivateMsg(sentMsg) {

		var string = `<li class="list-group-item">
                <div class="panel-heading"> To:
                <span class="senderUserNameNew" data-id="${sentMsg.id}">${sentMsg.userName}</span>
                <button data-id="${sentMsg.id}"
                class="btn btn-primary pull-right btn-xs btn-show-sent-message">
                <li class="fa fa-info-circle"></li> Show message
                </button>
                </div>
                <div class="panel-body btn-show-message-details">
                </div>
                </li>`;

		$sentMsgList.html($sentMsgList.html() + string);
	}

	//shows details for unread and already read received private messages
	$('body').on('click', '.btn-show-received-message', function () {

		var that = $(this);
		var id = that.data('id');

		var PrvMsgReadStatus = {
			readStatus: 1,
			prvMsgId: id
		};

		var boxNewMsg = that.closest('.list-group-item').find('.btn-warning');


		if (boxNewMsg.hasClass("btn-warning")) {
			$
				.ajax({
					url: '../../../rest/rest.php/privateMessage/' + id,
					type: 'PATCH',
					data: PrvMsgReadStatus
				})
				.done(function (response) {
					var prvMsgDetails = that.closest('.list-group-item').find('.btn-show-message-details');

					prvMsgDetails.text(response.success.text);
					boxNewMsg.removeClass("btn-warning");
					prvMsgDetails.slideToggle();

				})
				.fail(function (error) {
					console.log('Show sent private message error', error);
				});

		} else {

			$
				.ajax({
					url: '../../../rest/rest.php/privateMessage/',
					type: 'GET'
				})
				.done(function (response) {
					for (var i = 0; i < response.success.length; i++) {
						if (response.success[i].id == id) {

							var prvMsgDetails = that.closest('.list-group-item').find('.btn-show-message-details');
							prvMsgDetails.text(response.success[i].text);
							prvMsgDetails.slideToggle();

						} else {

						}
					}

				})
				.fail(function (error) {
					console.log('Show sent private message error', error);
				});
		}
	});

	$('body').on('click', '.btn-show-sent-message', function () {

		var that = $(this);
		var id = that.data('id');
		$
			.ajax({
				url: '../../../rest/rest.php/privateMessage/',
				type: 'GET'
			})
			.done(function (response) {
				for (var i = 0; i < response.sentPrvMsgs.length; i++) {
					if (response.sentPrvMsgs[i].id == id) {

						var sentPrvMsgDetails = that.closest('.list-group-item').find('.btn-show-message-details');
						sentPrvMsgDetails.text(response.sentPrvMsgs[i].text);
						sentPrvMsgDetails.slideToggle();
					}
				}

			})
			.fail(function (error) {
				console.log('Show sent private message error', error);
			});

	});

	var $filteredUsersArray = [];

	function getUsers() {

		$
			.ajax({
				url: '../../../rest/rest.php/privateMessage',
				type: 'GET'
			})
			.done(function (response) {
				for (var i = 0; i < response.users.length; i++) {
					$filteredUsersArray.push(response.users[i].userName);
					$filteredUsersArray.push(response.users[i].id);
				}

				console.log($filteredUsersArray);

			})
			.fail(function (error) {
				console.log('Create users array error', error);
			});
	}

	//search for users to whom private message would be sent




	// $($userSearchbox).on('keyup', function () {
	// 	event.preventDefault();
	//
	// 	var that = $(this);
	// 	var $input = $('#userSearch').val();
	// 	//var userlistElement = $(this).value;
	// 	console.log($input);
	//
	//
	// 	$
	// 		.ajax({
	// 			url: '../../../rest/restEndPoints/Privatemessage.php',
	// 			type: 'POST',
	// 			data: {
	// 				usernameQuery: $input
	// 			}
	// 		})
	// 		.done(function (response) {
	//
	// 			console.log(response.success);
	//
	// 			for (var i = 0; i < response.success.length; i++) {
	//
	// 				userlistElement = document.createElement('div');
	// 				userlistElement.innerHTML = response.success[i].userName;
	// 				userlistElement.setAttribute("data-user-id", response.success[i].id);
	// 				console.log(userlistElement);
	//
	// 				$userSearchbox.after(userlistElement);
	//
	// 				// $userSearchbox.appendChild(userlistElement);
	//
	// 				// if (response.sentPrvMsgs[i].id == id) {
	// 				//
	// 				// 	var sentPrvMsgDetails = that.closest('.list-group-item').find('.btn-show-message-details');
	// 				// 	sentPrvMsgDetails.text(response.sentPrvMsgs[i].text);
	// 				// 	sentPrvMsgDetails.slideToggle();
	// 				// }
	// 			}
	//
	// 		})
	// 		.fail(function (error) {
	// 			console.log('Username not found', error);
	// 		});
	// });



	// $userSearchbox.autocomplete({
	// 	source: function (request, response) {
	// 		$.ajax({
	// 			url: '../../../rest/restEndPoints/Privatemessage.php',
	// 			type: 'POST',
	// 			data: {
	// 				usernameQuery: $input
	// 			}
	// 		})
	// 			.done(function (data) {
	//
	// 				console.log(data.success);
	// 				// $usernameQueryResult.push(data);
	// 				// // response(data);
	// 				// // console.log($usernameQueryResult);
	//
	//
	// 							for (var i = 0; i < data.success.length; i++) {
	//
	// 								$filteredQueryResult.push(data.success[i].userName);
	//
	//
	// 							}
	// 				console.log($filteredQueryResult);
	//
	// 								// userlistElement = document.createElement('div');
	// 								// userlistElement.innerHTML = response.success[i].userName;
	// 								// userlistElement.setAttribute("data-user-id", response.success[i].id);
	// 								// console.log(userlistElement);
	// 								//
	// 								// $userSearchbox.after(userlistElement);
	//
	// 								// $userSearchbox.appendChild(userlistElement);
	//
	// 								// if (response.sentPrvMsgs[i].id == id) {
	// 								//
	// 								// 	var sentPrvMsgDetails = that.closest('.list-group-item').find('.btn-show-message-details');
	// 								// 	sentPrvMsgDetails.text(response.sentPrvMsgs[i].text);
	// 								// 	sentPrvMsgDetails.slideToggle();
	// 								// }
	//
	// 			})
	// 			.fail(function (error) {
	// 				console.log('Username not found', error);
	// 			})
	// 	}
	// });



	$(function() {
		$userSearchbox.autocomplete({
			source: $filteredUsersArray
		});
	} );

	getReceivedPrivateMsg();
	getSentPrivateMsg();
	getUsers();

	});