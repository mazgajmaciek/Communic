$(function () {

	var $receivedMsgList = $("#receivedMsgList");
	var $sentMsgList = $("#sentMsgList");

	function getReceivedPrivateMsg() {
		$
			.ajax({
				url: '../../../rest/rest.php/privateMessage',
				type: 'GET'
			})
			.done(function (response) {

				console.log(response);

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
				console.log(response);
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
                class="btn btn-primary pull-right btn-xs btn-show-received-message">
                <li class="fa fa-info-circle"></li> Show message
                </button>
                </div>
                <div class="panel-body btn-show-message-details">
                </div>
                </li>`;

		$sentMsgList.html($sentMsgList.html() + string);
	}

	$('body').on('click', '.btn-show-received-message', function () {

		var that = $(this);
		var id = that.data('id');

		var PrvMsgReadStatus = {
			readStatus: 1,
			prvMsgId: id
		};

		//TODO - Got to work on how to make PATCH working wish ajax/server-side - server gets updated but .done executes only on already read message - why?

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

					console.log(id);
					console.log(response);

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


	getReceivedPrivateMsg();
	getSentPrivateMsg();

	});