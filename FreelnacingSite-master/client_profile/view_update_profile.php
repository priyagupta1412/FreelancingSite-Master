<?php
ob_start();
include "../DB.php";
include "../auth.php";
if($_SESSION['client_userrole'] !== 'Client' )
{
	header("Location: ../register.php");
}

$client_id = $_SESSION['client_id'];
?>

<?php
$query_fetch = "SELECT * FROM client_profile WHERE client_id = {$client_id} ";
$result_fetch = mysqli_query($connection,$query_fetch);
while($row = mysqli_fetch_array($result_fetch))
{
	$client_mobile = $row['client_mobile'];
	$clientimage = $row['client_image'];
	$clientcompany = $row['client_company'];
	$companyaddress = $row['company_address'];
	$client_contact_email = $row['contact_email'];
	$client_contact_number = $row['contact_number'];
	$client_image = $row['client_image'];
}

?>





<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>View Profile</title>
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

		ul.navbar-nav a:hover {
			color: wheat !important;
		}

		ul.navbar-nav li {
			color: white;
		}

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

		.tab-content .card-header {
			border-radius: 50px;
		}

		.card:hover {
			background-color: rgb(242, 247, 246);
		}

	</style>
</head>

<body>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="jquery-3.5.1.min.js"></script>
	<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #292b2c;">
		<a class="navbar-brand" style="color: teal; font-weight: bold;" href="view_update_profile.php"><img src="../images/logo.jpg" alt="logo" style="border-radius: 5px; margin-bottom: -10px;"> Client Profile <br>
			<span style="font-size: 15px; margin-left: 30px;">( Alorb )</span> </a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown trainings">
					<a href="../client-dashboard.php" class="nav-link" style="padding-top: 20px; color:white;"> Back To Dashboard </a>
				</li>
				<li class="nav-item dropdown text-center">
					<a type="button" class="nav-link" style="color: white;">
						<?php echo $_SESSION['client_firstname'], "<br>"."( <span style='color: orange;'>". $_SESSION['client_userrole']."</span> )"; ?>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" href="../logout.php" style="padding-top: 20px; color: red;"> Logout </a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container">
		<div class="top-header bg-dark text-light text-center">
			<h1> Your Profile </h1>
		</div>




		<div class="row">
			<div class="col-sm">
				<div id="container">
					<div id="veiw-image">
						<h3 id="header">Profile Image</h3>
						<div id="preview-image">
							<div class="team-single-img">
								<img src="<?php echo $client_image; ?>" width="150px" height="150px" alt="">
							</div>
						</div>
					</div>
				</div>
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
						<input id="input3" type="number" class="form-control" value="<?php echo $client_mobile; ?>" aria-describedby="button-addon2" disabled>
						<div class="input-group-append" data-toggle="modal" data-target="#exampleModal"><button class="btn btn-outline-primary" type="button" id="button-addon2"><img src="edit.png" id="edit1"></button>
						</div>
					</div>
				</h4>
				<h2>Company Details</h2>
				<br>
				<h4> Company Name: <div class="input-group mb-3">
						<input id="input4" type="text" class="form-control" value="<?php echo $clientcompany; ?>" aria-describedby="button-addon2" disabled>
						<div class="input-group-append" data-toggle="modal" data-target="#exampleModal"><button class="btn btn-outline-primary" type="button" id="button-addon2"><img src="edit.png" id="edit1"></button>
						</div>
					</div>
				</h4>
				<h4> Address : <div class="input-group mb-3">
						<input id="input5" type="text" class="form-control" value="<?php echo $companyaddress; ?>" aria-describedby="button-addon2" disabled>
						<div class="input-group-append" data-toggle="modal" data-target="#exampleModal"><button class="btn btn-outline-primary" type="button" id="button-addon2"><img src="edit.png" id="edit1"></button>
						</div>
					</div>
				</h4>
				<br>
				<h2>Contact Details</h2>
				<br>
				<h4>Email : <div class="input-group mb-3">
						<input id="input6" type="text" class="form-control" value="<?php echo $client_contact_email; ?>" aria-label="Email" aria-describedby="button-addon2" disabled>
						<div class="input-group-append" data-toggle="modal" data-target="#exampleModal"><button class="btn btn-outline-primary" type="button" id="button-addon2"><img src="edit.png" id="edit1"></button>
						</div>
					</div>
				</h4>
				<br>
				<h4>Contact Number: <div class="input-group mb-3">
						<input id="input7" type="text" class="form-control" value="<?php echo $client_contact_number; ?>" aria-label="contactnumber" aria-describedby="button-addon2" disabled>
						<div class="input-group-append" data-toggle="modal" data-target="#exampleModal"><button class="btn btn-outline-primary" type="button" id="button-addon2"><img src="edit.png" id="edit1"></button>
						</div>
					</div>
				</h4>

			</div>

		</div>


		<?php 
		if(isset($_POST['update']))
{
			$client_id = $_SESSION['client_id'];
			$client_mobile = trim($_POST['mobile_number']);
			$client_company = trim($_POST['company_name']);
			$company_address = trim($_POST['company_address']);
			$client_contact_email = trim($_POST['contact_email']);
			$client_contact_number = trim($_POST['contact_number']);

			$client_mobile = mysqli_real_escape_string($connection,$client_mobile);
			$client_contact_email = mysqli_real_escape_string($connection,$client_contact_email);
			$client_contact_number = mysqli_real_escape_string($connection,$client_contact_number);

				$query_update = "UPDATE client_profile SET client_mobile = '{$client_mobile}', client_company = '{$client_company}', company_address = '{$company_address}', 
				contact_email = '{$client_contact_email}', contact_number = '{$client_contact_number}' WHERE client_id = {$client_id} ";
			
				$result_update = mysqli_query($connection,$query_update);
			if($result_update>0)
			{
				header("Location: ../client-dashboard.php");
			}
			
}

		
		?>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form action="" method="post">
						<div class="modal-header">
							<h5 class="modal-title text-center" id="exampleModalLabel">Update Profile</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body text-left" style="font-weight:bold;">
							<div class="form-group">
								<label for="exampleInputPassword1"> Mobile Number </label>
								<input type="text" class="form-control" name="mobile_number" placeholder="Enter Mobile Number" value="<?php echo $client_mobile; ?>">
							</div>
							<div class="form-group">
								<label for=""> Company Name </label>
								<input type="text" class="form-control" name="company_name" placeholder="Enter Mobile Number" value="<?php echo $clientcompany; ?>">
							</div>
							<div class="form-group">
								<label for=""> Company Address </label>
								<input type="text" class="form-control" name="company_address" placeholder="Enter Mobile Number" value="<?php echo $companyaddress; ?>">
							</div>
							<div class="form-group">
								<label for=""> Contact Email </label>
								<input type="text" class="form-control" name="contact_email" placeholder="Enter Mobile Number" value="<?php echo $client_contact_email; ?>">
							</div>
							<div class="form-group">
								<label for=""> Contact Number </label>
								<input type="text" class="form-control" name="contact_number" placeholder="Enter Mobile Number" value="<?php echo $client_contact_number; ?>">
							</div>


						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" name="update"> Update </button>
						</div>
					</form>
				</div>
			</div>
		</div>





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
