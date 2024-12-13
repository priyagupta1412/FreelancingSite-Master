	<?php
include "DB.php";
include "auth.php";
if($_SESSION['client_userrole'] !== 'Client' )
{
	header("Location: register.php");
}

$profile_id = $_SESSION['client_id'];
?>


	<?php

	$invites = "";
	$client_profile = "";
	if(isset($_GET['invite']))
	{
		if(isset($_GET['client_profile']))
		{
			$invites = $_GET['invite'];
			$client_profile = $_GET['client_profile'];
		}
	}
	$query_check = "INSERT INTO invitations(client_profile,user_token,invitation, status, invite_date, client_status)";
	$query_check .= "VALUES($client_profile,'{$invites}','invited', 'WAIT', CURRENT_TIMESTAMP, 'Not_checked')";
	
	$result_query = mysqli_query($connection,$query_check);
	if($result_query)
	{
		header("Location: client_invitations.php");
	}
	
	

	$clientprofile = "";
	$usertoken = "";
	if(isset($_GET['client_id']))
	{
		if(isset($_GET['usertoken']))
		{
			$clientprofile = $_GET['client_id'];
			$usertoken = $_GET['usertoken'];	
		}
	}
	$query_update = "UPDATE invitations SET invitations.client_status = 'Checked' WHERE invitations.client_profile = {$clientprofile} AND invitations.user_token = '{$usertoken}' ";
	$result_update = mysqli_query($connection,$query_update);
	if($result_update)
	{
		header("Location: client_invitations.php");
	}

	?>




	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> Your Invites </title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="my-hires.css">

		<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>
		<style>
			body {
				min-height: 100%;
				background-image: -webkit-linear-gradient(65deg, rgb(0, 0, 0), rgba(45, 168, 168, 0.658));
			}

			.container {
				padding-top: 1%;
			}

			.top-header {
				border-radius: 11px 0 110px 0;
				padding: 0.5% 13%;
				margin-bottom: 1%;
			}

			.top-header a {
				color: white;
			}

			.content .card-header {
				border-radius: 0 0 150px 150px;
			}

			.card:hover {
				background-color: rgb(242, 247, 246);
			}

			.card-link {
				text-decoration: none;
				cursor: pointer;
			}

			.row {
				margin: 0;
			}

			ul.navbar-nav a:hover {
				color: wheat !important;
			}

		</style>
	</head>

	<body class="text-left">

		<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
			<a class="navbar-brand" style="color: teal; font-weight: bold;" href="client_invitations.php"><img src="images/logo.jpg" alt="logo" style="border-radius: 5px; margin-bottom: -15px;"> Your Invites <br>
				<span style="font-size: 15px; margin-left: 50px;">( Alorb )</span></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a href="client-dashboard.php" class="nav-link" style="padding-top: 20px; color: white;">Back To Dashboard </a>
					</li>
					<li class="nav-item dropdown">
						<a href="search_freelancer.php" class="nav-link" style="padding-top: 20px; color: white;"> Invite a Freealncer </a>
					</li>

					<li class="nav-item dropdown">
						<a type="button" class="nav-link" style="color: white;">
							<?php echo $_SESSION['client_firstname'], "<br>"."( <span style='color: orange;'>". $_SESSION['client_userrole']."</span> )"; ?>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link" href="logout.php" style="padding-top: 20px; color: red;"> Logout </a>
					</li>
				</ul>
			</div>
		</nav>
		<form action="" method="post">
			<div class="row justify-content-md-center mb-3 content">
				<div class="col-md-8">
					<div class="card-header bg-dark text-center">
						Invites
					</div>

				</div>
			</div>
			<div class="row justify-content-md-center">
				<div class="col-md-8">
					<div class="card mb-1">
						<?php 	
					$verify = false;
			$select = "";
			if(isset($_POST['submit']))
			{
				$select = $_POST['select1'];
			}
			$query = "SELECT * FROM profilee, titletb, hourlytb, invitations WHERE profilee.profile_id = titletb.profile_id 
			AND hourlytb.profile_id = profilee.profile_id AND invitations.user_token = profilee.user_token_id ORDER BY invite_date DESC ";
			$result = mysqli_query($connection,$query);
			while($row = mysqli_fetch_array($result))
			{
				$verify = true;
				$user_name = $row['firstname'];
				$expertise = $row['expertise'];
				$title = $row['title'];
				$description = $row['professional_overview'];
				$rate = $row['hourly_rate'];
				$skills = $row['skills'];
				$user_token = $row['user_token_id'];
				$status = $row['status'];
				$client_status = $row['client_status'];
				$accepted_date = $row['user_accepted_date'];
			
			
		?>

						<div class="card-body">

							<h5 class="card-title">Freelancer's Name: <?php echo $user_name; ?></h5>
							<h6>Expertise: <span class="font-weight-bold"><?php echo $expertise; ?></span></h6>
							<p> $<?php echo $rate; ?> / <span class="text-muted">hr</span></p>
							<p class="card-text">
								<span class="font-weight-bold">About:</span><br>
								<?php echo $description; ?>
							</p>
							<p><b>Skills: </b> <?php echo $skills; ?></p>
							<?php 
						if($client_status == 'Checked')
						{
							echo "<a href = '#'><p class='text-right'><button class='btn btn-success' type='button'> Chat </button></p></a>";
							echo "<p style='margin-top: -5%;'> <b>Status : </b>  $status</p><br>
								 <p style='margin-top: -4%;'><b>Accepted on: </b> $accepted_date </p>";
						}
						else
						{
							echo "<p class='text-right'><button class='btn btn-success' type='button' disabled> Invited </button></p>";
							echo "<p style='margin-top: -5%;'> <b>Status : </b> 'Waiting' </p>";
						}
						
						?>
							<!-- <p><i class="fas fa-map-marker-alt"></i> India</p> -->

						</div>

						<div class="card-footer"><i class="fas fa-map-marker-alt"></i> India </div>
						<hr style="border: 1px dashed black;">
						<?php  } if(!$verify) { ?>

						<div class="text-center" style="height: 300px; margin-top: 10px;">
							<img src="images/emp.png" alt="" style="height:110px;weight:110px;"><br><br>
							<h3>Please Invite A freelancer <a href="search_freelancer.php">Click Here to Invite</a></h3>
							<p>Your Invited Freelancer Displays Here.</p>
						</div>


						<?php } ?>


					</div>

					<!-- Demo cards: Remove this while doing backend on it -->
					<!-- Upto here -->
				</div>
			</div>

		</form>



		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="index.js"></script>
	</body>

	</html>
