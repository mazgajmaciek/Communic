$(function () {

	var $receivedMsgList = $("#receivedMsgList");

	function getReceivedPrivateMsg() {
		$
			.ajax({
				url: '../../../rest/rest.php/privateMessage',
				type: 'GET'
			})
			.done(function (response) {

				console.log(response);

				for (var i = 0; i < response.success.length; i++) {
					if (response.success[i].readStatus == "0") {
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
				for (var i = 0; i < response.success.length; i++) {
					renderAuthor(response.success[i]);
					renderEditSelect(response.success[i]);

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
                </li>`;

		$receivedMsgList.html($receivedMsgList.html() + string);
	}

	function renderNewReceivedPrivateMsg(receivedMsg) {
		var string = `<li class="list-group-item">
                <div class="panel-heading btn-warning"> From:
                <b><span class="senderUserNameNew" data-id="${receivedMsg.id}">${receivedMsg.userName}</span></b>
                <button data-id="${receivedMsg.id}" 
                class="btn btn-primary pull-right btn-xs btn-show-received-message">
                <li class="fa fa-info-circle"></li> Show message
                </button>
                </div>
                </li>`;

		$receivedMsgList.html($receivedMsgList.html() + string);
	}

	$('body').on('click', '.btn-show-received-message', function (event) {
		//event.preventDefault();

		var id = $(this).data('id');
		var that = $(this);

		$
			.ajax({
				url: '../../../rest/rest.php/privateMessage/' + id,
				type: 'GET'
			})
			.done(function (response) {
				var descElement = that.closest('.list-group-item').find('.book-description');

				descElement.text(response.success[0].description);
				descElement.slideToggle();
			})
			.fail(function (error) {
				console.log('Show author description error', error);
			});

		renderPrvMsgDetails();
	});

	function renderPrvMsgDetails (messageId) {

	}

	getReceivedPrivateMsg();
	getSentPrivateMsg();

});