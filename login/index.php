<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body class="img js-fullheight" style="background-color: black;">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Have an account?</h3>
				  <div id="error"></div>
		    <form class="signin-form" id="signin_form">
		      	<div id="username-input" class="form-group">
		      		<input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
		      	</div>
	            <div id="password-input"class="form-group">
	              <input type="" name="password" id="password" class="form-control" placeholder="Password" required>
	            </div>
	            <div class="form-group">
	            	<button type="submit" id="signin" name="signin" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	        </form>
	          <p class="w-100 text-center">&mdash; New to this? &mdash;</p>
	          <div class="social d-flex text-center">
	          	<a href="signup.php" class="px-2 py-2 mr-md-1 rounded">Sign up</a>
	          </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script>
	  $(document).ready(function(){
		$('.submit').click(function(e){
			$(".error-block").remove();
		    $(".alert").remove();
	  		e.preventDefault();
	  		var username = $('#username').val();
	  		var password = $('#password').val();
	  		$.ajax({	
				url: "app_logic.php",
				type: "POST",				
	  			data:{
				  'login': 1,
				  'username': username,
				  'password': password
			    },
				beforeSend: function(){
				  	$('#signin').html("signing in...");
				},
				success: function(data){
					var data = JSON.parse(data);
				    if(data.status != "success"){
					  if(data.errors.username){
                        $("#username-input").append('<div class="error-block" style="color:red;">'+data.errors.username+'</div>');
					  }
					  if(data.errors.password){
                        $("#password-input").append('<div class="error-block" style="color:red;">'+data.errors.password+'</div>');
					  }
					  $('#error').html('<div class="alert alert-danger">'+data.message+'</div>');
					  $('#signin').html("sign in");
				    }else{
					  $('#error').html('<div class="alert alert-success">'+data.message+'</div>');
					  location.href = "../index.php";	
				    }
	  			}
	  		});
	  	});
	  });
  </script>
	</body>
</html>

