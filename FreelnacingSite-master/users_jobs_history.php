<?php include "auth.php"; 
include "DB.php";
include "functions.php";
$user_profile_id = $_SESSION['id'];
if($_SESSION['userrole'] !== 'Freelancer' )
{
	header("Location: register.php");
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Post Jobs</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="my-hires.css">
	<link rel="stylesheet" href="style.css">

	<script src="https://kit.fontawesome.com/18dd5346aa.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light text-left">
	<style>
		.container {
			padding-top: 1%;
		}

		.top-header {
			border-radius: 110px 0 110px 0;
			padding: 0.5% 13%;
			margin-bottom: 1%;
		}

		.top-header a {
			color: white;
		}

	</style>

	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="user_dasboard.php"><img src="images/logo.jpg" alt="logo" style="border-radius: 5px; margin-bottom: -10px;"> User Applied Jobs <br> <span style="font-size: 15px; margin-left: 80px;">( Alorb )</span> </a>
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
				<li class="nav-item dropdown">
					<a href="view_profile.php" class="nav-link" style="padding-top: 20px; color:white;"> View My Profile <img class="feed-profile-logo" src="images/feed-profile-logo.jpg" alt=""></a>
				</li>&nbsp;
				<li class="nav-item dropdown text-center">
					<a type="button" class="nav-link" style="color: white;">
						<?php echo $_SESSION['firstname'], "<br>"."( <span style='color: orange;'>". $_SESSION['userrole']."</span> )"; ?>
					</a>
				</li>&nbsp;
				<li class="nav-item dropdown">
					<a class="nav-link" href="logout.php" style="padding-top: 20px; color: red;"> Logout </a>
				</li>

			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="top-header bg-dark text-light text-center">
			<h1> Jobs You Applied </h1>
		</div>
	</div>

	<div class="container">


		<!--***************************************	MAIN SECTION SATRTS          ************************************************-->

		<div class="jumbotron tab-content profile-tab" id="myTab1Content" style="border:2px solid grey;shadow:2px 3px;background:white;">
			<div class="tab-pane fade show active" id="hires" role="tabpanel" aria-labelledby="home-tab">
				<?php
				$verify = false;
			$company_name  = "";
			$query = "SELECT * FROM users_applied_jobs, client_job_posting WHERE client_job_posting.c_token = users_applied_jobs.client_token AND 
			users_applied_jobs.user_profile_id = {$user_profile_id} ";
			$result = mysqli_query($connection,$query);
			while($row = mysqli_fetch_array($result))
			{
				$verify = true;
				$job_title = $row['job_title'];
				$company_name = $row['company_name'];
				$client_name = $row['client_name'];
				$job_description = $row['job_description'];
				$skills = $row['job_expertise_skills'];
				$job_vacancy = $row['job_vacanies'];
				$pay_like = $row['client_pay_like'];
				$date = $row['apply_date'];
				$client_req_experience = $row['client_req_experience'];
				$job_status = $row['hire_status'];
				$hired_date = $row['hired_date'];
				
			?>

				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title"> Apply for: <?php echo $job_title; ?></h5><span class="text-dark" style="float: right;"><b>Apply On: <?php echo $date;  ?></b></span>
							<h6> Company Name: <span style="font-weight: normal;"><?php echo $company_name; ?></span></h6>
							<p><?php echo $pay_like; ?> | <span class="text-uppercase"><?php echo $client_req_experience; ?></span> | Est. Budget $500 |</p>
							<h6>Job Description: </h6>
							<p class="card-text">
								<?php echo $job_description;?>
							</p>
							<p><b>Skills Required:</b> <?php echo $skills; ?></p>
							<p>Proposals: <span class="text-uppercase"><?php echo $job_vacancy; ?></span></p>
							<p><i class="fas fa-map-marker-alt"></i> India</p>
							<p><b>Client Name : </b><?php echo $client_name; ?></p>
							<p><?php if($job_status == 'Hired'){echo "<b>Hired On :</b> ". $hired_date; } ?></p>
							<a href="" style="float:right; margin-top: -25px;"><?php if($job_status == 'Hired'){ 
							echo "<button class='btn btn-success'>$job_status</button> <a href='users_chat.php' class='btn btn-info'>Chat</a>"; } else { echo "<button class='btn btn-primary' disabled>Already Applied</button>"; }?>
							</a>
						</div>
					</div>

				</div>
				<hr style="background-color: black;">
				<?php } if(!$verify) { ?>

				<div class="text-center" style="height: 100%; margin-top: 10px;">
					<img src="images/emp.png" alt="" style="height:110px;weight:110px;"><br><br>
					<h3>Its seems that you haven't Applied any Jobs Yet! </h3>
					<h5> Want to Apply <a href="find_work.php"> Check Here!</a></h5>
					<p> Jobs You Applied Displays Here.</p>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<!--**********************************88   MAIN ENDS            ************************************************-->


		

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>
