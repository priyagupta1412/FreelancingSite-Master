<?php 
include "../auth.php";
include "../DB.php";
if($_SESSION['client_userrole'] !== 'Client' )
{
	header("Location: ../register.php");
}
?>

<?php
if(isset($_POST['submit']))
{
	$client_id = $_SESSION['client_id'];
	$client_name = $_SESSION['client_firstname'];
	$client_email = $_SESSION['client_email'];
	$client_mobile = trim($_POST['mobile_number']);
	$client_company = trim($_POST['company_name']);
	$company_address = trim($_POST['company_address']);
	$client_contact_email = trim($_POST['contact_email']);
	$client_contact_number = trim($_POST['contact_number']);
	$client_image = $_POST['image'];
	
	$client_mobile = mysqli_real_escape_string($connection,$client_mobile);
	$client_contact_email = mysqli_real_escape_string($connection,$client_contact_email);
	$client_contact_number = mysqli_real_escape_string($connection,$client_contact_number);
	
	$query_insert = "INSERT INTO client_profile(client_id, client_name, client_email, client_mobile, client_image, client_company, company_address, contact_email, contact_number) ";
	$query_insert .= "VALUES($client_id, '{$client_name}', '{$client_email}', '{$client_mobile}', '{$client_image}', '{$client_company}', '{$company_address}', '{$client_contact_email}', '{$client_contact_number}')";
	$result_query = mysqli_query($connection,$query_insert);
	if($result_query)
	{
		header("Location: ../client-dashboard.php");
	}
	else{
		header("Location: client_profile.php");
	}
}




?>





<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="../style.css">

	<style media="screen">
		#container {
			width: 50%;
			padding: 2%;
			margin: 10px auto;
		}

		#image {
			width: 96%;
			padding: 2%;
			border: 1px dashed green;
		}

		#header {
			background: #405570;
			color: white;
			text-align: center;
			padding: 2%;
		}

		#view-image {
			border-radius: 5px;
			overflow: hidden;
		}

		#preview-image {
			padding: 1%;
			border: 1px solid #efefef;
			height: 400px;
		}

		.form-control {
			border: none;
			border-bottom: 3px green solid;
		}

	</style>
</head>

<body>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="jquery-3.5.1.min.js"></script>
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="#"><img src="../images/logo.jpg" alt="logo" style="border-radius: 5px;"> Alorb Freelancing</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown trainings">
					<a href="" class="nav-link" style="padding-top: 20px;">Report</a>
				</li>
				<li class="nav-item dropdown">
					<a type="button" class="nav-link" style="color: white;">
						Login as <?php echo $_SESSION['client_firstname'], "<br>"."( <span style='color: orange;'>". $_SESSION['client_userrole']."</span> )"; ?>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="../logout.php" style="padding-top: 20px;"> Logout </a>
				</li>
			</ul>
		</div>
	</nav>


	<center>
		<h1> Let's Build Your Profile </h1>
	</center> <br><br><br><br>
	<div class="container">

		<form action="" method="post">
			<div class="row">
				<div class="col-sm">
					<div id="container">
						<form action="upload_file.php" method="post">
							<input type="file" name="image" id="image" / required>
						</form>
						<div id="veiw-image">
							<h3 id="header">Profile Image</h3>
							<div id="preview-image">

							</div>
						</div>
					</div>
					<button class="btn btn-success" name="submit" type="submit">Submit</button>
				</div>
				<br>

				<div class="col-md">
					<h2>Client Details</h2>

					<h4>Name: <div class="input-group mb-3">
							<input id="input1" type="text" class="form-control" value="<?php echo $_SESSION['client_firstname']; ?>" aria-describedby="button-addon2" disabled>

						</div>
					</h4>

					<h4>Email Address: <div class="input-group mb-3">
							<input id="input2" type="email" class="form-control" value="<?php echo $_SESSION['client_email']; ?>" aria-describedby="button-addon2" disabled>

						</div>
					</h4>

					<h4>Mobile Number: <div class="input-group mb-3">
							<input id="input3" type="number" class="form-control" value="" aria-describedby="button-addon2" name="mobile_number" required>

						</div>
					</h4>
					<h2>Company Details</h2>
					<br>

					<h4> Company Name: <div class="input-group mb-3">
							<input id="input4" type="text" class="form-control" value="" aria-describedby="button-addon2" name="company_name" required>

						</div>
					</h4>


					<h4> Address : <div class="input-group mb-3">
							<input id="input5" type="text" class="form-control" value="" aria-describedby="button-addon2" name="company_address" required>

						</div>
					</h4>
					<br>
					<h2>Contact Details</h2>
					<br>

					<h4>Email : <div class="input-group mb-3">
							<input id="input6" type="text" class="form-control" value="" aria-label="Email" aria-describedby="button-addon2" name="contact_email" required>

						</div>
					</h4>
					<br>

					<h4>Contact Number: <div class="input-group mb-3">
							<input id="input7" type="text" class="form-control" value="" name="contact_number" aria-label="contactnumber" aria-describedby="button-addon2" required>

						</div>
					</h4>

				</div>

			</div>
		</form>


		<script type="text/javascript">
			$(document).ready(function() {
				$('#image').change(function() {
					var data = new FormData();
					data.append('file', $('#image')[0].files[0]);
					$.ajax({
						url: 'upload_file.php',
						type: 'POST',
						data: data,
						processData: false,
						contentType: false,
						beforeSend: function() {
							$('#preview-image').html('Loading...');
						},
						success: function(data) {
							// alert(data);
							$('#preview-image').html('<img  src="' + data + '" style="width:100%"/>');

						}
					});
					return false;
				});
			});

		</script>
	</div>
	
	

	
	<script lang="javascript" type="text/javascript">
		window.history.forward();

	</script>

</body>

</html>
