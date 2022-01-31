<!doctype html>
<html lang="en">
  <head>
  	<title>Signup</title>
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
					<h2 class="heading-section">Signup</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
					<div id="error"></div>
		    <form class="signup-form" id="signup_form">
                <div id="name-input" class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                </div>
		      	<div id="username-input" class="form-group">
		      			<input type="text" class="form-control" id="username" name="username" placeholder="Username">
		      	</div>
                <div id="email-input" class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
	            <div id="password-input" class="form-group">
	              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
	            </div>
				<div id="cpassword-input"  class="form-group">
	              <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
	            </div>
	            <div class="form-group">
	            	<button type="submit" name="signup" id="signup" class="form-control btn btn-primary submit px-3">Signup</button>
	            </div>
	        </form>
	        <p class="w-100 text-center">&mdash; Already have an account?&mdash;</p>
			<div class="social d-flex text-center">
                <a href="index.php" class="px-2 py-2 mr-md-1 rounded">Sign in</a>
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
					$('#signup').click(function(e){
						$(".error-block").remove();
		                $(".alert").remove();
	  		            e.preventDefault();
						var name = $('#name').val();
						var username = $('#username').val();
						var email = $('#email').val();
						var password = $('#password').val();
						var cpassword = $('#cpassword').val();
						$.ajax({
							url:'app_logic.php',
							type: 'POST',
							data:{
								'register': 1,
								'name': name,
								'username': username,
								'email': email,
								'password': password,
								'cpassword': cpassword
							},
							beforeSend: function(){
				  	           $('#signup').html("signing up...");
				            },
							success:function(data){
							  var data = JSON.parse(data);
				              if(data.status != "success"){
								if(data.errors.name){
                                    $("#name-input").append('<div class="error-block" style="color:red;">'+data.errors.name+'</div>');
					            }
								if(data.errors.username){
                                    $("#username-input").append('<div class="error-block" style="color:red;">'+data.errors.username+'</div>');
					            }	
								if(data.errors.unique_username){
                                    $("#username-input").append('<div class="error-block" style="color:red;">'+data.errors.unique_username+'</div>');
								}
								if(data.errors.email){
                                    $("#email-input").append('<div class="error-block" style="color:red;">'+data.errors.email+'</div>');
					            }
					            if(data.errors.password){
                                    $("#password-input").append('<div class="error-block" style="color:red;">'+data.errors.password+'</div>');
					            }
								if(data.errors.cpassword){
                                    $("#cpassword-input").append('<div class="error-block" style="color:red;">'+data.errors.cpassword+'</div>');
					            }
								if(data.errors.passwords){
									$("#password-input").append('<div class="error-block" style="color:red;">'+data.errors.passwords+'</div>');
								}
								$('#error').html('<div class="alert alert-danger">'+data.message+'</div>');
					            $('#signup').html("sign up");
				              }else{
								$('#signup_form')[0].reset();
					            $('#error').html('<div class="alert alert-success">'+data.message+'</div>');
								$('#signup').html("sign up");
							  }
							}
						});
					});
				});
			</script>
	</body>
</html>

