<?php
	session_start();
	
	if (file_exists('../../connection.php')) {
		require('../../connection.php');
	} else {
		$_SESSION['error_msg'] = "Failed to connect to database.";
		header("Location: register.php");
		exit();
	}

	/* UIT TIJDENS TESTEN

	// Rate limiter to prevent too many registration attempts
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$current_time = time();
	$limit = 5;

	// Check if we have a record of registration attempts from this IP address
	if (isset($_SESSION['registration_attempts'][$ip_address])) {
		// Get the number of attempts and the time of the last attempt
		$attempts = $_SESSION['registration_attempts'][$ip_address]['attempts'];
		$last_attempt = $_SESSION['registration_attempts'][$ip_address]['last_attempt'];
		
		// Check if the number of attempts exceeds the limit and if so, sleep until
		// the limiter expires
		if ($attempts >= $limit) {
			$time_remaining = 300 - ($current_time - $last_attempt);
			sleep($time_remaining);
		}
	}

	// Update the number of attempts and the time of the last attempt
	$_SESSION['registration_attempts'][$ip_address] = array(
		'attempts' => isset($attempts) ? $attempts + 1 : 1,
		'last_attempt' => $current_time
	);

	*/
	
	// Start of the database entry
	if(isset($_POST['register'])){
		if($_POST['username'] != "" && $_POST['email'] != "" && $_POST['password'] != "" && $_POST['confirm_password'] != ""){
		  if($_POST['password'] != $_POST['confirm_password']){
			$_SESSION['error_msg'] = "The entered passwords don't match, please try again.";
			header('location: register.php');
		  }
		  else{
			try{
			  $username = htmlspecialchars(trim($_POST['username']));
			  $email = htmlspecialchars(trim($_POST['email']));
			  $password = hash('sha256', trim($_POST['password']));
			  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  
			  // Check if the username is too long
			  if (strlen($username) > 27) {
				$_SESSION['error_msg'] = "Username is too long, please choose a shorter one!";
				header('location: register.php');
				exit();
			  }
			  // Check if username or email already exists in the database
			  $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = :username OR `email` = :email");
			  $stmt->bindParam(':username', $username);
			  $stmt->bindParam(':email', $email);
			  $stmt->execute();
			  // redirect to registration if the username exists
			  if ($stmt->rowCount() > 0) {
				$_SESSION['error_msg'] = "Username or email already exists, please choose a different one!";
				header('location: register.php');
				exit();
			  }else{
				// Insert new user into the database
				$stmt = $conn->prepare("INSERT INTO `users` (username, email, password) VALUES (:username, :email, :password)");
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':password', $password);
				$stmt->execute();
				$_SESSION['message']=array("text"=>"User successfully created!","alert"=>"info");
				header('location: login.php');
			  }
			}catch(PDOException $e){
			  echo $e->getMessage();
			}
		  }
		}else{
		  $_SESSION['error_msg'] = "Please fill in the required fields!";
		  header('location: register.php');
		}
	  }
		  
?>
