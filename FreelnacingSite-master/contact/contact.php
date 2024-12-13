<?php
include "../DB.php";
include "../auth.php";
include "../functions.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title> Contact Us- Alorb</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../images/iniesta-logo.jpg">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="../style.css" type="text/css">

	<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>
	<!--===============================================================================================-->
</head>

<body>
	<style>
		ul.navbar-nav a:hover {
			color: wheat !important;
		}
	</style>
	<!-- ************************* Navbar Starts here *******************************-->

	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="contact.php"><img src="../images/iniesta-logo.jpg" alt="iniesta-logo" style="border-radius: 5px; margin-bottom: -20px;"> Contact Us <br> <span style="font-size: 15px; margin-left: 40px;">( Alorb )</span> </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown trainings">
					<a href="../client-dashboard.php" class="nav-link" style="color: white; padding-top: 20px;"> Go Back To Dashboard </a>
				</li>

				<li class="nav-item dropdown">
    <a type="button" class="nav-link" style="color: white;">
        Login as 
        <?php 
        // Check if 'firstname' and 'userrole' are set in the session
        if (isset($_SESSION['firstname']) && isset($_SESSION['userrole'])) {
            echo $_SESSION['firstname'] . "<br>( <span style='color: orange;'>" . $_SESSION['userrole'] . "</span> )";
        } else {
            echo "Guest <br>( <span style='color: orange;'>No Role</span> )";
        }
        ?>
    </a>
</li>

				<li class="nav-item dropdown">
					<a href="../logout.php" type="button" class="nav-link" style="color: yellow; padding-top:20px;">
						Logout
					</a>
				</li>
			</ul>
		</div>
	</nav>

	<!--*****************************************8	Navbar Ends    *******************************88-->

	<div class="container-contact100">
		<div class="contact100-map" id="google_map" data-map-x="40.722047" data-map-y="-73.986422" data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

		<div class="wrap-contact100">
			<span class="contact100-form-symbol">
				<img src="images/icons/symbol-01.png" alt="SYMBOL-MAIL">
			</span>

			<form class="contact100-form validate-form flex-sb flex-w" method="post">
				<span class="contact100-form-title">
					Drop Us A Message
				</span>

				<div class="wrap-input100 rs1 validate-input" data-validate="Name is required">
					<input class="input100" type="text" name="username" placeholder="Name">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 rs1 validate-input" data-validate="Email is required: e@a.z">
					<input class="input100" type="email" name="email" placeholder="Email Address">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Message is required">
					<textarea class="input100" name="message" placeholder="Write Us A Message"></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" type="submit" name="submit_email">
						Send
					</button>
				</div>
			</form>
		</div>
	</div>
	
	
	

	
	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<!--
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFWBqlKAGCeS1rMVoaNlwyayu0e0YRes"></script>
	<script src="js/map-custom.js"></script>
-->
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!--	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>-->
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		// gtag('config', 'UA-23581568-13');
	</script>
</body>

</html>