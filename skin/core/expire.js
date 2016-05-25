dpm.checkLogInStatus = function()
{
	$.ajax({
		url: "app/configs/session.php",
		type: "GET",
		success: function( data ) {
			var html = '';

			if(data == "-1")
			{
				$.get(url+'access/logout');
				html += '<div id="messageBoxConfirmScreen"></div>';
				html += '<div id="messageBoxConfirm" class="shadow-md">';
				html += '<div id="modalWindowHeader">';
				html += '<img class="pull-right" src="'+url+'media/images/minimal_dpm_logo.png" alt="'+url+'media/images/minimal_dpm_logo.png"/>';
				html += '</div>';
				html += '<div id="modalWindowBody" class="text-center">';
				html += '<h4 class="titleHeader">Your session has expired<br>Please log in again...</h4>';
				html += '</div>';
				html += '<div id="modalWindowFooter">';
				html += '<button onclick="document.location.reload()" class="btn btn-danger">Log In</button>';
				html += '</div>';
				html += '</div>';
				$('body').append(html);
				
				$("#messageBoxConfirmScreen").on({
					'mousewheel': function(e) {
						e.preventDefault();
						e.stopPropagation();
					}
				});
				
				$("#messageBoxConfirm").on({
					'mousewheel': function(e) {
						e.preventDefault();
						e.stopPropagation();
					}
				});
				
				dpm.stopLogInCheck();
			}
		}
	});
};

dpm.startLogInCheck = setInterval(dpm.checkLogInStatus, 5000);

dpm.stopLogInCheck = function() {
	clearInterval(dpm.startLogInCheck);
};