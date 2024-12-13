<?php 
include "auth.php";
include('DB.php');
$profile_id = $_SESSION['id'];
if($_SESSION['userrole'] !== 'Freelancer' )
{
	header("Location: register.php");
}
?>

<html>

<head>
	<title>Iniesta</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>
	<script src="https://use.typekit.net/hoy3lrg.js"></script>
	<script>
		try {
			Typekit.load({
				async: true
			});
		} catch (e) {}

	</script>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="msg_dashboard.css">
	<!--<link rel="stylesheet" href="style.css">-->
</head>

<body>
	<style>
		ul.navbar-nav a:hover {
			color: wheat !important;
		}

	</style>

	<!---Navigation bar-->
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="index_2.php"><img src="images/logo.jpg" alt="logo" style="border-radius: 5px; margin-bottom: -20px;"> Chat Dashboard <br> <span style="font-size: 15px; margin-left: 70px;">( Alorb )</span> </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">

				<li class="nav-item dropdown">
					<a type="button" class="nav-link" style="color: white;">
						Login as <?php echo $_SESSION['firstname'], "<br>"."( <span style='color: orange;'>". $_SESSION['userrole']."</span> )"; ?>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a href="logout.php" type="button" class="nav-link" style="color: red; padding-top:20px;">
						Logout
					</a>
				</li>
			</ul>
		</div>
	</nav>
	<!---Navigation bar end-->
	<div class="body-container">
		<!-----------------Client DP and Name------------------------->
		<div id="frame">
			<div id="sidepanel">
				<div id="profile">
					<div class="wrap">
						<img id="profile-img" src="http://emilcarlsson.se/assets/mikeross.png" class="online" alt="" />
						<p><?php echo($_SESSION['firstname']); ?></p>
					</div>
				</div>
				<div id="search">
					<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
					<input type="text" placeholder="Search contacts..." />
				</div>


				<!---------- freelancer contacts ------------------------>
				<div id="contacts">
					<ul id="user_details">



					</ul>
				</div>
				<!--<div id="bottom-bar">
        bottom bar options if any

		</div>-->
			</div>
			<div class="content-box" id="user_model_details">


			</div>
		</div>
	</div>
	<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
	<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
	<script>
		$(".messages").animate({
			scrollTop: $(document).height()
		}, "fast");


		function newMessage() {
			message = $(".message-input input").val();
			if ($.trim(message) == '') {
				return false;
			}
			$('<li class="sent"><p>' + message + '</p></li>').appendTo($('.messages ul'));
			$('.message-input input').val(null);
			$('.contact.active .preview').html('<span>You: </span>' + message);
			$(".messages").animate({
				scrollTop: $(document).height()
			}, "fast");
		};

		$('.submit').click(function() {
			newMessage();
		});

		$(window).on('keydown', function(e) {
			if (e.which == 13) {
				newMessage();
				return false;
			}
		});

	</script>

	
	
				
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="index.js"></script>

	<script>
		$(document).ready(function() {

			fetch_user();
			setInterval(function() {
				update_last_activity();
				fetch_user();
				update_chat_history_data();
			}, 5000);

			function fetch_user() {
				$.ajax({
					url: "fetch_user.php",
					method: "POST",
					success: function(data) {
						$('#user_details').html(data);
					}
				});
			}

			function update_last_activity() {
				$.ajax({
					url: "update_last_activity.php",
					success: function() {

					}
				});
			}

			function make_chat_dialog_box(to_user_id, to_user_name) {
				var modal_content = '<div class="contact-profile" id="user_dialog_' + to_user_id + '"><img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" /> <p>' + to_user_name + '</p></div>';
				modal_content += '<div id="chat_history_' + to_user_id + '" class="chat_history messages" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
				modal_content += fetch_user_chat_history(to_user_id);
				modal_content += '</div>';
				modal_content += '<div class="message-input">';
				modal_content += '<div class="wrap">';
				modal_content += '<textarea name="chat_message_' + to_user_id + '" id="chat_message_' + to_user_id + '" class="form-control" align="left"></textarea>';
				modal_content += '<i class="fa fa-paperclip attachment" aria-hidden="true"></i>';
				modal_content += '<button type="button" name="send_chat" id="' + to_user_id + '" class="send_chat" ><i class="fa fa-paper-plane" aria-hidden="true"></i></button></div></div></div>';

				$('#user_model_details').html(modal_content);
			}
			$(document).on('click', '.start_chat', function() {
				var to_user_id = $(this).data('touserid');
				var to_user_name = $(this).data('tousername');

				make_chat_dialog_box(to_user_id, to_user_name);

			});

			$(document).on('click', '.send_chat', function() {

				var to_user_id = $(this).attr('id');
				var chat_message = $('#chat_message_' + to_user_id).val();

				$.ajax({
					url: "insert_chat.php",
					method: "POST",
					data: {
						to_user_id: to_user_id,
						chat_message: chat_message
					},
					success: function(data) {
						$('#chat_message_' + to_user_id).val('');
						$('#chat_history_' + to_user_id).html(data);
					}
				});
			});

			function fetch_user_chat_history(to_user_id) { //alert("dsadsa");
				$.ajax({
					url: "fetch_user_chat_history.php",
					method: "POST",
					data: {
						to_user_id: to_user_id
					},
					success: function(data) {

						$('#chat_history_' + to_user_id).html(data);
					}
				});
			}

			function update_chat_history_data() {
				$('.chat_history').each(function() {
					var to_user_id = $(this).data('touserid');
					fetch_user_chat_history(to_user_id);
				});
			}



		});

	</script>
</body>

</html>
