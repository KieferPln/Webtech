<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Registration</title>
		<link rel="stylesheet" type="text/css" href="./styles_reg.css"/>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	</head>
<body>
	<div class="header">
		<div class="col-md-8">
		<div class="alert-danger" id="error_msg" style="display:
		<?php if(isset($_SESSION['error_msg'])) echo 'block'; else echo 'none'; ?>;">
		<?php if(isset($_SESSION['error_msg'])) echo $_SESSION['error_msg']; unset($_SESSION['error_msg']);?>
		</div>
			<form action="register_query.php" method="POST">	
				<div class="text_header">
					<h4>Sign Up</h4>
				</div>
				<div class="text_login">
					<label>Username</label>
					<br/>
					<input type="text" class="form-control" name="username" required />
				<!-- </div>
				<div class="form-group"> -->
				<br/>
					<label>Email</label>
					<br/>
					<input type="email" class="form-control" name="email" required />
				<!-- </div> -->
				<br/>
				<!-- <div class="form-group"> -->
					<label>Password</label>
					<br/>
					<input type="password" class="form-control" name="password" required />
				<!-- </div> -->
				<br/>
				<!-- <div class="form-group"> -->
					<button class="btn btn-primary form-control" name="register">Register</button>
				</div>
				<div class="login_button">
				<p>Already have an account?<p> 
				</div>
				<div class="Signin">
					<p><a href="index.php">Log In!</a><p> 
				</div>
			</form>
		</div>
	</div>
</body>
</html>