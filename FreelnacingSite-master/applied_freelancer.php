<?php include "auth.php"; 
include "DB.php";
include "functions.php";
if($_SESSION['client_userrole'] !== 'Client')
{
	header("Location: register.php");
}
$profile_id = $_SESSION['client_id'];
$user_token = "";
$client_token = "";

if(isset($_GET['client_token']))
{
	if(isset($_GET['user_token']))
	{
		$user_token = $_GET['user_token'];
		$client_token = $_GET['client_token'];
	}
}

$query_update = "UPDATE users_applied_jobs SET status = 'read' WHERE users_applied_jobs.client_token = '{$client_token}' 
AND users_applied_jobs.user_token_id = '{$user_token}' ";
$result_update = mysqli_query($connection,$query_update);
confirmQuery($result_update);


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
		ul.navbar-nav a:hover {
			color: wheat !important;
		}

	</style>
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="applied_freelancer.php"><img src="images/iniesta-logo.jpg" alt="iniesta-logo" style="border-radius: 5px; margin-bottom: -12px;"> Applied Freelancer <br> <span style="font-size: 15px; margin-left: 70px;">( INIESTA )</span></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a href="client-dashboard.php" class="nav-link" style="padding-top: 20px; color: white;">Back To Dashboard </a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="my-hired.php" style="padding-top: 20px; color: white;"> Hired Freelancer </a>
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


	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light rounded" id="head-navbar">

			<ul class="nav nav-tabs" id="myTab1" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="mh" data-toggle="tab" href="#hires" role="tab" aria-controls="hires" aria-selected="true"> <b>Applied Freelancer</b> </a>
				</li>
			</ul>
		</nav>

		<!--***************************************	MAIN SECTION SATRTS          ************************************************-->

		<div class="jumbotron tab-content profile-tab" id="myTab1Content" style="border:2px solid grey;shadow:2px 3px;background:white;">
			<div class="tab-pane fade show active" id="hires" role="tabpanel" aria-labelledby="home-tab">
				<?php
				$verify = false;
				$hired_client_token = "";
				$hired_user_token = "";
				$query = "SELECT users_applied_jobs.client_token, users_applied_jobs.user_token_id, users_applied_jobs.hire_status, users_applied_jobs.user_name, users_applied_jobs.apply_date, 
				profilee.skills, regestration.user_email, e_leveltb.expertise_level, users_applied_jobs.applied_for, titletb.title, 
				employmenttb.employ_company ,employmenttb.employ_job_title FROM users_applied_jobs, client_job_posting , profilee, regestration, e_leveltb, titletb, employmenttb
				WHERE users_applied_jobs.client_token = client_job_posting.c_token AND client_job_posting.client_id = {$profile_id} AND profilee.user_token_id = users_applied_jobs.user_token_id
				AND regestration.user_id = users_applied_jobs.user_profile_id AND e_leveltb.profile_id = users_applied_jobs.user_profile_id AND users_applied_jobs.user_profile_id = titletb.profile_id 
				AND employmenttb.profile_id = users_applied_jobs.user_profile_id";
				
				$result = mysqli_query($connection,$query);
				while($row = mysqli_fetch_array($result))
				{
					$verify = true;
					$username = $row['user_name'];
					$skills = $row['skills'];
					$email = $row['user_email'];
					$e_level = $row['expertise_level'];
					$userrole_position = $row['title'];
					$apply_for = $row['applied_for'];
					$past_company = $row['employ_company'];
					$past_job_title = $row['employ_job_title'];
					$apply_date = $row['apply_date'];
					$hired_status = $row['hire_status'];
					$client_token_hire = $row['client_token'];
					$user_token_hire = $row['user_token_id'];
				
				
			?>
				<div id="content" class="Data border p-2" style="line-height: 1.8;;">
					<h4>Apply for : <?php echo $apply_for; ?></h4>
					<div class="row">
						<div class="col-sm-6"><span style="font-weight: bold;">Name :</span> <?php echo $username; ?> </div>
						<div class="col-sm-6"><span style="font-weight: bold;">Email :</span> <?php echo $email; ?></div>
						<div class="col-sm-6"><span style="font-weight: bold;">Skills :</span> <?php echo $skills; ?> </div>
						<div class="col-sm-6"><span style="font-weight: bold;">Level of Expertise :</span> <?php echo $e_level; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-6"><span style="font-weight: bold;">Role or Position :</span> <?php echo $userrole_position; ?> </div>
					</div>
					<div class="row">
						<div class="col-sm-6"><span style="font-weight: bold;"> Past Experience :</span> <?php echo $past_job_title." at " . $past_company; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-6"><span style="font-weight: bold;"> Apply On :</span> <?php echo $apply_date; ?></div>
					</div>
					<div class="row">
						<div class="col-sm-12"> <a href="my-hired.php?hired_c_token=<?php echo base64_encode($client_token_hire).'&hired_u_token='.base64_encode($user_token_hire); ?>" style="float: right; margin-top: -20px;">
								<?php if($hired_status == 'unhired'){echo "<span class='btn btn-primary'> Want to Hire </span>"; } else { echo "<button class='btn btn-success' disabled> Hired </button>"; } ?> </a></div>
					</div>
				</div>
				<hr>
				<?php } if(!$verify) { ?>

				<div class="text-center" style="height: 100%; margin-top: 10px;">
					<img src="images/emp.png" alt="" style="height:110px;weight:110px;"><br><br>
					<h3>It's Seems that none of the freelancer has applied to your job Yet! </h3>
					<h5> Or It might be you haven't Posted a job yet. <a href="view_job_post.php"> Check Here! </a> Or Wait for freelancer</h5>
					<p>Any Freelancer applied to your jobs will Displays here.</p>
				</div>
				<?php } ?>


			</div>
		</div>
	</div>

	<!--**********************************88   MAIN ENDS            ************************************************-->


	
	
						


	
	<!--  <script>
  $(document).ready(function() {
		    $('#saved').hide();
        //$(".icha0").css({ 'background-color' : '', 'opacity' : '' });
        $("#se").removeClass("act");
        $('#mh').addClass("act");


		    });


  $('.abc').click(function() {
     $('#content div').hide();
     var target = '.' + $(this).data('target');
     $(target).show();
     $('#mh').removeClass("act");
     $('#se').addClass("act");
})
 $('#mh').click(function(){
   $(this).addClass("act");
   $('#se').removeClass("act");
 });
</script>-->
</body>

</html>
