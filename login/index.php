<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="./styles_reg.css"/>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
	<div class="header">
		<div class="col-md-8">
			<?php if(isset($_SESSION['message'])): ?>
				<div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg"><?php echo $_SESSION['message']['text'] ?></div>
			<script>
				(function() {
					// removing the message 3 seconds after the page load
					setTimeout(function(){
						document.querySelector('.msg').remove();
					},3000)
				})();
			</script>
			<?php 
				endif;
				// clearing the message
				unset($_SESSION['message']);
			?>
			<form action="login_query.php" method="POST">	
				<div class="text_header">	
					<h4>Login here</h4>
				</div>
				<hr style="border-top:1px groovy #000;">
				<div class="text_login">
					<label>Username</label>
					<br/>
					<input type="text" class="form-control" name="username" />
				<!-- </div>
				<div class="form-group"> -->
				<br>
					<label>Password</label>
					<br/>
					<input type="password" class="form-control" name="password" />
				<!-- </div> -->
					<br>
				<!-- <div class="form-group"> -->
					<button class="btn btn-primary form-control" name="login">Login</button>
					
				</div>
			</form>
			<div class="login_button">
				<p>Don't have an account yet?</p>
			</div>
			<div class="make_account">
				<p><a href="registration.php">Sign up!</a><p>
		</div>
	</div>
</body>
</html>