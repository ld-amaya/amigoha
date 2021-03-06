<script>
	var userLoggedIn = '<?php echo $user['username']; ?>';
	$(document).ready(function(){
		$('.dropdown_window').scroll(function(){
			var message_height = $('.dropdown_window').innerHeight(); //div containing the post -> '.post_area'
			var scroll_top = $('.dropdown_window').scrollTop(); //current top of the displayed page
			var page = $('.dropdown_window').find('.ShowNextMessages').val();
			var NoMoreMessages = $('.dropdown_window').find('.NoMoreMessages').val();

			if ((scroll_top + message_height >=$('.dropdown_window')[0].scrollHeight) && NoMoreMessages == 'false') {
                
                var pageName; //holds the name of the page to send ajax request
                var type = $('#dropdown_data_type').val();

                if (type == 'notification'){
                    pageName = "ajax_load_notifications.php";
                } else if (type == 'message') {
                    pageName = "ajax_load_messages.php"
                }
                
				var ajaxReq = $.ajax({
					url: "includes/handlers/" + pageName,
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache: false,
						
					success: function(response){
						$('.dropdown_window').find('.ShowNextMessages').remove(); //Removes current .nextpage
						$('.dropdown_window').find('.NoMoreMessages').remove(); //Removes current .nextpage
						$('.dropdown_window').append(response);
					}
				}); //end of ajax document
			} 	
		}); //end of window scroll function
	});//end of document
</script>