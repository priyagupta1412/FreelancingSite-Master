<?php 
session_start();
ob_start();
include "DB.php";
include "functions.php";
?>

<?php 
$error = "";
$db_username = "";
$db_password = "";
$db_user_role = "";
$USERNAME = "";
$PASSWORD = "";
if(isset($_POST['signin']))
{
	$USERNAME = trim($_POST['username']);
	$PASSWORD = trim($_POST['password']);
	
	$username = mysqli_real_escape_string($connection,$USERNAME);
	$password = mysqli_real_escape_string($connection,$PASSWORD);
	
	$query = "SELECT * FROM login WHERE user_email = '{$username}' ";
	$result_query = mysqli_query($connection,$query);
	if(!$result_query)
	{
		die("Connection Failed!".mysqli_error($connection));
	}
	while($row = mysqli_fetch_assoc($result_query))
	{
		$db_id = $row['user_id'];
		$db_username = $row['user_email'];
		$db_lastname = $row['lastname'];
		$db_firstname = $row['firstname'];
		$db_password = $row['user_password'];
		$db_user_role = $row['user_role'];
	}
	if($db_username !== $USERNAME && $db_password !== $PASSWORD)
	{
//		$error = "Invalid Username or Password!";
		echo "<script>alert('Invalid Username or Password')</script>";
		
	}
	else if ($db_username == $USERNAME && $db_password == $PASSWORD && $db_user_role == "Client")
	{
		$_SESSION['firstname'] = $db_firstname;
		$_SESSION['userrole'] = $db_user_role;
		$_SESSION['id'] = $db_id;
		header("Location: client-dashboard.php");
	}
	
	else if ($db_username == $USERNAME && $db_password == $PASSWORD && $db_user_role == "Freelancer")
	{
		$_SESSION['id'] = $db_id;
		$_SESSION['userrole'] = $db_user_role;
		$_SESSION['firstname'] = $db_firstname;
		$_SESSION['lastname'] = $db_lastname;
		$_SESSION['email'] = $db_username;
		
		check_profile($_SESSION['id']);
	}
	
	
	else
	{
			echo "<script>alert('Invalid Username or Password')</script>";
	}
	
	$session_id = session_id();
	$_SESSION['auth'] = $session_id;
	
	

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Alorb </title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link href="style.css" rel="stylesheet">
	<link rel="icon" type="image/png" href="images/iniesta-logo.jpg">
	<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>

	<script>
		$(".contentContainer").css("min-height", $(window).height());
		$("#image").css("min-height", $("#beeweek").height());
		$(document).ready(function() {

			$("#submitButton").click(function() {

				$("#myModal").modal('show');
			})
		});
		$(".video-container").css("min-height", $(window).height());

	</script>


</head>

<body>



	<style>
		.fa-info-circle {
			color: black;
			float: right;
			position: absolute;
			top: 25px;
			right: 25px;
			font-size: 1.2em;
			border-color: black transparent transparent transparent;
		}

		ul.navbar-nav a:hover {
			color: wheat !important;
		}

	</style>



	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="#"><img src="images/logo.jpg" alt="logo" style="border-radius: 5px;"> Alorb Freelancing</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">

				<li class="nav-item dropdown">
					<a href="#" class="nav-link" style=" color: white;">Solutions</a>
				</li>
				<li class="nav-item dropdown trainings">
					<a href="register.php" class="nav-link" style=" color: white;">Post a job</a>
				</li>
				<li class="nav-item dropdown">
					<a href="register.php" class="nav-link" style=" color: white;">Register</a>
				</li>
				<li class="nav-item dropdown">
					<a type="button" class="nav-link" data-toggle="modal" data-target="#exampleModal" style="color: yellow;">
						Login >
					</a>
				</li>
			</ul>
		</div>
	</nav>


	<!-- Login modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Login</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="index.php" method="post">
					<div class="modal-body">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Username" name="username" required><a href="#" onclick="return false" data-toggle="tooltip" title="Username is your Email Id which you provided at the time of registeration"><i class="fas fa-info-circle"></i></a>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password" name="password" required>

						</div>
						<div style="text-align: right;">
							<a href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forget password?</a>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" name="signin" class="btn btn-info">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Login modal end -->



	<div class="welcome-title">
		<h1>In-demand talent on demand&#8482;</h1>
		<h1 class="green">Alorb-Freelancing is how.</h1>
		<h6>Alorb-Freelancing expertly connects professionals and agencies to businesses seeking specialized talent.
		</h6>
	</div>

	<style>
		.card-body p {
			color: black;
		}

	</style>
	<!-- <hr class="green"> -->
	<div class="container-fluid body-section" style="padding-top: 4%;">
		<?php //echo $count; ?>
		<h1 style="color: teal; text-shadow: 1px 1px 2px grey; line-height: 2;">Find quality talent and agencies</h1>
		<div class="category-container row">
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/Web,Mobile&SoftwareDev.png" class="card-img-top" alt="...">
					<div class="card-body">
						<a href="register.php">
							<p>Mobile & Website dev</p>
						</a>
					</div>
				</div>
			</div>

			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/Writing.png" class="card-img-top" alt="...">
					<div class="card-body">
						<a href="register.php">
							<p>Writing</p>
						</a>
					</div>
				</div>
			</div>
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/Sales&Marketing.png" class="card-img-top" alt="...">
					<div class="card-body">
						<a href="register.php">
							<p>Sale & Marketing</p>
						</a>
					</div>
				</div>
			</div>
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/Engineering&Architecture.png" class="card-img-top" alt="...">
					<div class="card-body">
						<a href="register.php">
							<p>Engineering & Architecture</p>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="category-container row">
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/Design&Creative.png" class="card-img-top" alt="...">
					<div class="card-body"><a href="register.php">
							<p>Design & Creative</p>
						</a>
					</div>
				</div>
			</div>
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/DataScience&Analytics.png" class="card-img-top" alt="...">
					<div class="card-body"><a href="register.php">
							<p>DataScience & Analytics</p>
						</a>
					</div>
				</div>
			</div>
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/CustomerService.png" class="card-img-top" alt="...">
					<div class="card-body"><a href="register.php">
							<p>Customer Service</p>
						</a>
					</div>
				</div>
			</div>
			<div class="category-card col-md-3">
				<div class="card">
					<img src="images/Admin Support.png" class="card-img-top" alt="...">
					<div class="card-body"><a href="register.php">
							<p>Admin Support</p>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script lang="javascript" type="text/javascript">
		window.history.forward();

	</script>

	<script>
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});

	</script>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="index.js"></script>
</body>

</html>
