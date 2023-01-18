<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="./styles_reg.css"/>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	</head>
<body>
	<div class="header">
		<div class="col-md-8">
			<form action="register_query.php" method="POST">	
				<div class="text_header">
					<h4>Register here</h4>
				</div>
				<div class="text_login">
					<label>Username</label>
					<br/>
					<input type="text" class="form-control" name="username" />
				<!-- </div>
				<div class="form-group"> -->
				<br/>
					<label>Email</label>
					<br/>
					<input type="email" class="form-control" name="email" />
				<!-- </div> -->
				<br/>
				<!-- <div class="form-group"> -->
					<label>Password</label>
					<br/>
					<input type="password" class="form-control" name="password" />
				<!-- </div> -->
				<br/>
				<!-- <div class="form-group"> -->
					<button class="btn btn-primary form-control" name="register">Register</button>
				</div>
				<div class="login_button">
				<p>already have an account?<p> 
				</div>
				<div class="Signin">
					<p><a href="./">Sign in!</a><p> 
				</div>
			</form>
		</div>
	</div>
</body>
</html>