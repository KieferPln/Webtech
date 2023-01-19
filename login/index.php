<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Life Below Water: Log In</title>
	<link rel="stylesheet" type="text/css" href="./styles_reg.css"/>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
</head>
<body>
	<div class="header">
		<div class="col-md-8">
		<div class="alert-success" id="success_msg" style="display:
		<?php if(isset($_SESSION['message'])) echo 'block'; else echo 'none'; ?>;">
    	<?php if(isset($_SESSION['message'])) echo $_SESSION['message']['text']; unset($_SESSION['message']);?>
		</div>
		<div class="alert-danger" id="error_msg" style="display:
		<?php if(isset($_SESSION['error_msg'])) echo 'block'; else echo 'none'; ?>;">
		<?php if(isset($_SESSION['error_msg'])) echo $_SESSION['error_msg']; unset($_SESSION['error_msg']);?>
		</div>
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
					<h4>Log In</h4>
				</div>
				<hr style="border-top:1px groovy #000;">
				<div class="text_login">
					<label>Username</label>
					<br/>
					<input id='text-box-input'  type="text" class="form-control" name="username" />
				<!-- </div>
				<div class="form-group"> -->
				<br>
					<label>Password</label>
					<br/>
					<input id='text-box-input' type="password" class="form-control" name="password" />
				<!-- </div> -->
					<br>
				<!-- <div class="form-group"> -->
					<button class="btn btn-primary form-control" name="login">Log In</button>
					
				</div>
			</form>
			<div class="login_button">
				<p>Don't have an account yet?</p>
			</div>
			<div class="make_account">
				<p><a href="registration.php">Sign Up!</a><p>
		</div>
	</div>
</body>
</html>