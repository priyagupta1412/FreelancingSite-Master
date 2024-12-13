<?php include "auth.php"; 
include "DB.php";
$profile_id = $_SESSION['id'];
if($_SESSION['userrole'] !== 'Freelancer' )
{
	header("Location: register.php");
}
?>

<?php
$token = "";
$query = "SELECT * FROM profilee WHERE profile_id = {$profile_id} ";
$result = mysqli_query($connection,$query);
while($row = mysqli_fetch_array($result))
{
	$token = $row['user_token_id'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> DashBoard </title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="style.css">

	<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light text-left">

	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="user_dasboard.php"><img src="images/logo.jpg" alt="logo" style="border-radius: 5px; margin-bottom: -10px;"> User Dashboard <br> <span style="font-size: 15px; margin-left: 80px;">( Alorb )</span> </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<style>
				ul.navbar-nav a:hover {
					color: wheat !important;
				}

			</style>
			<ul class="navbar-nav ml-auto">


				<?php
				$query = "SELECT * FROM client_job_posting, users_applied_jobs
					WHERE client_job_posting.c_token = users_applied_jobs.client_token  AND users_applied_jobs.user_profile_id = {$profile_id} ";
				$result = mysqli_query($connection,$query);
				while($row = mysqli_fetch_array($result))
				{
					$client_token = $row['client_token'];
					$client_id = $row['client_id'];
				
				
				
				$message = "";
				$query = "SELECT * FROM chat_message WHERE from_user_id = {$client_id} AND status = 1 ";
				$result = mysqli_query($connection,$query);
				while($row = mysqli_fetch_array($result))
				{
					$message++;
				}
				}
				?>

				<li class="nav-item dropdown">
					<a href="users_chat.php" class="nav-link" style="padding-top: 20px; color: white;"><i class="fas fa-envelope"> </i> </a>
				</li>&nbsp;

				<?php if($message>0) { ?>
				<span class="text-success" style="margin-top: 10px; font-weight: bold; margin-left: -10px;"> <?php echo $message; ?></span>
				<?php } ?>&nbsp;&nbsp;



				<li class="nav-item dropdown">
					<a class="nav-link" href="users_jobs_history.php" style="padding-top: 20px; color:yellow"> View Applied Jobs </a>
				</li>

				<li class="nav-item dropdown">
					<a href="view_profile.php" class="nav-link" style="padding-top: 20px; color:white;"> Check Profile </a>
				</li>&nbsp;

				<ul class="navbar-nav mr-auto" style="hover: none;">
					<li class="nav-item dropdown">


						<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

							<i class="fas fa-bell" style="color: white; padding-top: 18px;">
								<?php 
							$count = "";
					$query = "SELECT * FROM invitations WHERE user_token = '{$token}' AND invitation = 'invited' AND status ='WAIT' "; 					
					$result_query = mysqli_query($connection,$query);
					while($row = mysqli_fetch_assoc($result_query))
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
					$query = "SELECT * FROM invitations WHERE user_token = '{$token}' AND invitation = 'invited' ";
					$result_query = mysqli_query($connection,$query);
					while($row = mysqli_fetch_assoc($result_query))
					{
						$invite = $row['invitation'];
						$date = $row['invite_date'];
						$status = $row['status'];
						$client_id = $row['client_profile'];
						$user_token = $row['user_token'];
					
					?>
							<a class="dropdown-item" href="user_accepted_invitation.php?client_id=<?php echo $client_id.'&user_token='.$user_token; ?> ">
								<p><?php echo $_SESSION['firstname']; ?><br><?php if($status == 'WAIT'){echo "<b><span style='color: lightskyblue;'> Client Invitation 
								<br> <button class = 'btn btn-success'> Accept Offer </button></span></b>"; }
						
								else{ echo "Client Invitation 
								<br> <button class = 'btn btn-success' disabled> Accepted! </button>"; } ?><br><small>Invited on: <?php echo $date; ?></small></p>
							</a>
							<div class="dropdown-divider"></div>
							<?php } ?>
						</div>
					</li>
				</ul>&nbsp;






				<li class="nav-item dropdown text-center">
					<a type="button" class="nav-link" style="color: white;">
						<?php echo $_SESSION['firstname'], "<br>"."( <span style='color: orange;'>". $_SESSION['userrole']."</span> )"; ?>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="logout.php" style="padding-top: 20px; color: red;"> Logout </a>
				</li>

			</ul>
		</div>
	</nav>

	<div class="container top-container-client-dashboard">
		<div class="text-right mb-5 mt-3">
			<a href="find_work.php" class="btn btn-info"> Apply to a Job </a>&nbsp;
			<a href="user_accepted_invitation.php" class="btn btn-dark text-light"> View Client Invitation </a>
		</div>
		<div class="row justify-content-md-center">
			<div class="col-md-6">
				<div class="card text-center card-client-dashboard">
					<div class="card-header bg-dark text-light card-header-client-dashboard" style="border-radius: 10px 10px 0 0;">
						Your applied jobs
					</div>
					<div class="alert alert-info">
						<strong> Note! </strong> Apply to a job Here
					</div>

					<div class="card-body" style="padding: 10% 5%;">
						<p> The more jobs you apply, More will be you getting Hired. </p>
						<a href="find_work.php" class="btn btn-primary"> Apply Here </a>

					</div>
				</div>
			</div>
		</div>
	</div>

	


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="index.js"></script>
</body>

</html>
