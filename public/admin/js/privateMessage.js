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

	// function getSentPrivateMsg() {
	// 	$
	// 		.ajax({
	// 			url: '../../../rest/rest.php/privateMessage',
	// 			type: 'GET'
	// 		})
	// 		.done(function (response) {
	// 			for (var i = 0; i < response.success.length; i++) {
	// 				renderAuthor(response.success[i]);
	// 				renderEditSelect(response.success[i]);
	//
	// 			}
	// 			console.log(response);
	// 		})
	// 		.fail(function (error) {
	// 			console.log('Create author error', error);
	// 		});
	// }

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

	$('body').on('click', '.btn-show-received-message', function () {

		var that = $(this);
		var id = $(this).data('id');

		var PrvMsgReadStatus = {
			readStatus: 1,
			prvMsgId: id
		};

		$
			.ajax({
				url: '../../../rest/rest.php/privateMessage/' + id,
				type: 'PATCH',
				data: PrvMsgReadStatus
			})
			.done(function (response) {

				console.log(id);
				console.log(response);


				var prvMsgDetails = that.closest('.list-group-item').find('.btn-show-message-details');


				prvMsgDetails.text(response.success.text);
				prvMsgDetails.slideToggle();

				var boxNewMsg = that.closest('.list-group-item').find('.btn-warning');
				boxNewMsg.removeClass("btn-warning");

				//TODO - ajax to be completed for POSTing db update for read message
				// if (response.success[id].readStatus === "0") {
				// 	// renderNewReceivedPrivateMsg(response.success[i]);
				//
				// 	$
				// 		.ajax({
				// 			url: '../../../rest/rest.php/privateMessage/' + id,
				// 			type: 'PATCH',
				// 			data: PrvMsgReadStatus
				// 		})
				// 		.done(function (response) {
				// 			console.log(PrvMsgReadStatus);
				// 			console.log(response);
				// 		})
				// 		.fail(function (error) {
				// 			console.log('Update private message read status error', error);
				// 		})
				//
				//
				//
				// }
			})
			.fail(function (error) {
					console.log('Show sent private message error', error);
				});




			});

	getReceivedPrivateMsg();
	// getSentPrivateMsg();

	});