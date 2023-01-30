<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Life Below Water: Sign Up</title>
		<link rel="stylesheet" type="text/css" href="./styles_reg.css"/>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    	<link rel="icon" type="image/png" sizes="32x32" href="/var/www/html/favicon/favicon-32x32.png">
    	<link rel="icon" type="image/png" sizes="16x16" href="/var/www/html/favicon/favicon-16x16.png">
    	<link rel="manifest" href="/site.webmanifest">
    	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
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
					<input id='text-box-input' type="text" class="form-control" name="username" required />
				<!-- </div>
				<div class="form-group"> -->
				<br/>
					<label>Email</label>
					<br/>
					<input id='text-box-input'  type="email" class="form-control" name="email" required />
				<!-- </div> -->
				<br/>
				<!-- <div class="form-group"> -->
					<label>Password</label>
					<br/>
					<input id='text-box-input'  type="password" class="form-control" name="password" required />
				<!-- </div> -->
				<br/>
				<!-- <div class="form-group"> -->
				</div>

				<div class='register_button_place'>
				<button style='color:#7864f5' name="register">Register</button>
				</div>

				<div class="login_button">
				<p>Already have an account?<p> 
				</div>
				<div class="Signin">
					<p><a href="login.php">Log In!</a><p> 
				</div>
			</form>
		</div>
	</div>
</body>
</html>