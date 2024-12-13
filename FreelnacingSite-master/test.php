
<!DOCTYPE html><html class=''>
<head>
<title>Alorb</title>

<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>
<script src="https://use.typekit.net/hoy3lrg.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="msg_dashboard.css">
</head>
<body>

	<!---Navigation bar-->
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
        <a class="navbar-brand" style="color: teal; font-weight: bold;" href="#"><img src="logo.jpg"
                alt="logo" style="border-radius: 5px;"> Alorb Freelancing</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="" class="nav-link">Find Work</a>
                </li>
                <li class="nav-item dropdown trainings">
                    <a href="" class="nav-link">My Jobs</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="">Messages</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="" class="nav-link">My Profile &nbsp; <img class="feed-profile-logo"
                            src="images/feed-profile-logo.jpg" alt=""></a>
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
				<p>Client Name</p>
			</div>
		</div>
		<div id="search">
			<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
			<input type="text" placeholder="Search contacts..." />
		</div>


    <!---------- freelancer contacts ------------------------>
		<div id="contacts">
			<ul>
				<li class="contact active">
					<div class="wrap">
						<img src="http://emilcarlsson.se/assets/louislitt.png" alt="" /><!-- frelancer display picture-->
						<div class="meta">
							<p class="name">Freelancer Name</p><!-- frelancer Name-->
							<p class="preview">freelancers last msg</p><!-- frelancer Last message-->
						</div>
					</div>
				</li>
        <li class="contact">
					<div class="wrap">
						<img src="http://emilcarlsson.se/assets/louislitt.png" alt="" /><!-- frelancer display picture-->
						<div class="meta">
							<p class="name">Freelancer Name</p><!-- frelancer Name-->
							<p class="preview">freelancers last msg</p><!-- frelancer Last message-->
						</div>
					</div>
				</li>
			</ul>
		</div>
		<!--<div id="bottom-bar">
        bottom bar options if any

		</div>-->
	</div>
	<div class="content-box">
		<div class="contact-profile">
			<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" /> <!-- frelancer display picture (present chatting)-->
			<p>Present chatting Freelancer</p><!-- chatting freelancer name-->
		</div>
		<div class="messages"><!--client sent("sent") msgs and received("replies") replies-->
			<ul>
				<li class="sent">
					<p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
				</li>
				<li class="replies">
					<p>When you're backed against the wall, break the god damn thing down.</p>
				</li>
				<li class="replies">
					<p>Excuses don't win championships.</p>
				</li>
				<li class="sent">
					<p>Oh yeah, did Michael Jordan tell you that?</p>
				</li>
			</ul>
		</div>
		<div class="message-input">
			<div class="wrap">
			<input type="text" placeholder="Write your message..." />
            <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
			<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
</div></div>
<script src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script >$(".messages").animate({ scrollTop: $(document).height() }, "fast");


function newMessage() {
	message = $(".message-input input").val();
	if($.trim(message) == '') {
		return false;
	}
	$('<li class="sent"><p>' + message + '</p></li>').appendTo($('.messages ul'));
	$('.message-input input').val(null);
	$('.contact.active .preview').html('<span>You: </span>' + message);
	$(".messages").animate({ scrollTop: $(document).height() }, "fast");
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
    
   
</body>
</html>