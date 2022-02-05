<?php session_start(); 
if(!isset($_SESSION['user_id'])){
  header('Location: ./login/index.html');
}
?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="./login/css/style.css">

	</head>
	<body class="img js-fullheight" style="background-color: black;">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Profile</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Update your profile</h3>
				  <div id="error"></div>
				  Hey, <?=$_SESSION['username']?>!<a style="float: right;" href="./login/logout.php">Logout</a>
				<div class="card">  
					<div class="card-body">
                       <p class="card-text" style="color: black">
						   <b>Name:</b> <span id="name"></span> <br/>
						   <b>Email:</b> <span id="email"></span>
					    </p>
                    </div>
                </div>
		        <form id="update-form" class="update-form">
		      		<div id="age-input" class="form-group">
                        <label>Age *</label>
		      			<input type="number" class="form-control" id="age" name="age" placeholder="age" required>
		      		</div>
                    <div id="dob-input" class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div id="phone-input" class="form-group">
                        <label>Phone Number *</label>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="phone number" required>
                    </div>
	                <div class="form-group">
	            	    <button type="submit" id="update" class="form-control btn btn-primary submit px-3">Update</button>
	                </div>
	            </form>
		           </div>
		        </div>
			</div>
		</div>
	</section>
  <script src="./login/js/jquery.min.js"></script>
  <script src="./login/js/popper.js"></script>
  <script src="./login/js/bootstrap.min.js"></script>
  <script src="./login/js/main.js"></script>
  <script src="./login/js/ajax.js"></script> 
</body>
</html>

