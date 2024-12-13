<?php
include "DB.php";
include "auth.php";
if($_SESSION['client_userrole'] !== 'Client' )
{
	header("Location: index.php");
}

$profile_id = $_SESSION['client_id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Feeds</title>

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
		ul.navbar-nav a:hover{
			color: wheat!important;
		}
		.badge:hover{
			color: wheat!important;
		}
	</style>
</head>

<body class="text-left">

	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="search_freelancer.php"><img src="images/logo.jpg" alt="logo" style="border-radius: 5px; margin-bottom: -15px;"> Search Freelancer<br>
			<span style="font-size: 15px; margin-left: 80px;">( Alorb )</span></a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a href="client-dashboard.php" class="nav-link" style="padding-top: 20px; color: white;">Back To Dashboard </a>
				</li>
				<li class="nav-item dropdown">
					<a href="client_invitations.php" class="nav-link" style="padding-top: 20px; color: white;"> Your Invites </a>
				</li>&nbsp;




				<ul class="navbar-nav mr-auto" style="">
					<li class="nav-item dropdown">
						<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-bell" style="color: white; padding-top: 18px;"> 
								<?php 
							$count = "";	
							$query = "SELECT * FROM invitations WHERE client_status = 'Not_checked' AND status = 'Accepted' AND client_profile = {$profile_id} ";
							$query_update = mysqli_query($connection,$query);
							while(mysqli_fetch_array($query_update))
							{
								$count++;
							}
							if($count>0)
							{
							?>
					
								<span class="badge badge-success"> <?php echo $count; ?></span>
								<?php } ?>
							</i>
						</a>

						<div style="margin-left: -20px;" class="dropdown-menu" aria-labelledby="navbarDropdown">
							<p class="noti" style="text-align: center; ">Notifications <span class="badge badge-success"> <?php echo $count; ?></span></p>
							<div class="dropdown-divider"></div>
							<?php
							$query = "SELECT * FROM invitations WHERE client_status = 'Not_checked' AND status = 'Accepted' AND client_profile = {$profile_id} ";
							$query_update = mysqli_query($connection,$query);
							while($row = mysqli_fetch_array($query_update))
							{
								$date = $row['user_accepted_date'];
								$status = $row['status'];
								$client_status = $row['client_status'];
								$usertoken = $row['user_token'];
								$client_id = $row['client_profile'];
							
						
					
					?>
							<a class="dropdown-item" href="client_invitations.php?client_id=<?php echo $client_id.'&usertoken='.$usertoken; ?> ">
								<p><br><?php if($client_status == 'Not_checked'){echo "<b><span style='color: lightskyblue;'>$status</span></b>";}else{ echo $status; } ?><br><small>Accepted on: <?php echo $date; ?></small></p>
							</a>
							<div class="dropdown-divider"></div>
							<?php } ?>
						</div>
					</li>
				</ul>&nbsp;




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
					Feeds
				</div>


				<div class="input-group my-3">

					<select class="custom-select" name="select1" id="" style="border-radius: 50px 0 0 50px;">
						<option value="<?php echo $select; ?>">Search in a particular category</option>
						<option value="Accounting & Consulting">Accounting & Consulting</option>
						<option value="Admin Support">Admin Support</option>
						<option value="Customer Service">Customer Service</option>
						<option value="Data Science and Analytics">Data Science and Analytics</option>
						<option value="Design & Creative">Design & Creative</option>
						<option value="Engineering & Architecture">Engineering & Architecture</option>
						<option value="IT & Networking">IT & Networking</option>
						<option value="Legal">Legal</option>
						<option value="Sales & Marketing">Sales & Marketing</option>
						<option value="Transiation">Transiation</option>
						<option value="Web & Mobile Development">Web & Mobile Development</option>
						<option value="Writing">Writing</option>
					</select>
					<div class="input-group-append">
						<button type="submit" name="submit" class="btn btn-light" style="border-radius: 0 50px 50px 0;"><i class="fas fa-search"></i></button>
					</div>

				</div>

			</div>
		</div>
		<div class="row justify-content-md-center">
			<div class="col-md-8">
				<div class="card mb-1">
					<?php 	
					$invites = "";
					$select = "";
			if(isset($_POST['submit']))
			{
				$select = $_POST['select1'];
			}
			$query = "SELECT * FROM profilee, titletb, hourlytb WHERE profilee.profile_id = titletb.profile_id 
			AND hourlytb.profile_id = profilee.profile_id AND profilee.expertise = '{$select}' ";
			$result = mysqli_query($connection,$query);
				if(mysqli_num_rows($result) > 0)
				{
			while($row = mysqli_fetch_array($result))
			{
				$user_name = $row['firstname'];
				$expertise = $row['expertise'];
				$title = $row['title'];
				$description = $row['professional_overview'];
				$rate = $row['hourly_rate'];
				$skills = $row['skills'];
				$user_token = $row['user_token_id'];
				
					$query_check = "SELECT * FROM invitations WHERE invitation = 'invited' AND user_token = '{$user_token}' ";
					$result_check = mysqli_query($connection,$query_check);
					while($row = mysqli_fetch_array($result_check))
					{
						$invites = $row['invitation'];
					}
			
			
			
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

						<p class='text-right'><a href="client_invitations.php?invite=<?php echo $user_token.'&client_profile='.$profile_id;  ?>"><?php if($invites){ echo "<button class='btn btn-success' disabled> Invited Already </button>"; } 
							else { echo "<button class='btn btn-success' type='button'> Want to Invite </button>"; } ?></a></p>


					</div>
					<div class="card-footer"><i class="fas fa-map-marker-alt"></i> India </div>
					<hr style="border: 1px dashed black;">
					<?php  }} else { ?>

					<div class="text-center" style="height: 100%; margin-top: 10px;">
						<img src="images/emp.png" alt="" style="height:110px;weight:110px;"><br><br>
						<h3>Please Choose a Category First</h3>
						<h6>If nothing is displays after selecting a category then it might be the case there is till now no freealncer of that category</h6>
						<p>Your Selected Options Freelancer's Category Displays Here</p>
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