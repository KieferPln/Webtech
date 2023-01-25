<?php
	session_start();
	require_once('../../connection.php');

	// Rate limiter to prevent too many registration attempts
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$current_time = time();
	$limit = 5;

	// Check if we have a record of registration attempts from this IP address
	if (isset($_SESSION['registration_attempts'][$ip_address])) {
		// Get the number of attempts and the time of the last attempt
		$attempts = $_SESSION['registration_attempts'][$ip_address]['attempts'];
		$last_attempt = $_SESSION['registration_attempts'][$ip_address]['last_attempt'];
		
		// Check if the number of attempts exceeds the limit
		if ($attempts >= $limit) {
			// Calculate the time remaining until the rate limit resets
			$time_remaining = 300 - ($current_time - $last_attempt);
			// Sleep for the time remaining
			sleep($time_remaining);
		}
	}

	// Update the number of attempts and the time of the last attempt
	$_SESSION['registration_attempts'][$ip_address] = array(
		'attempts' => isset($attempts) ? $attempts + 1 : 1,
		'last_attempt' => $current_time
	);

	// Start of the database entry
	if(ISSET($_POST['register'])){
		if($_POST['username'] != "" && $_POST['email'] != "" && $_POST['password'] != "" && $_POST['confirm_password'] != ""){
			if($_POST['password'] != $_POST['confirm_password']){
				// Store error message in a session variable
				$_SESSION['error_msg'] = "Your passwords don't seem too match up, please try again.";
				// Redirect to registration page
				header('location: ./register.php');
			}
			else{
				try{
					$username = $_POST['username'];
					$email = $_POST['email'];
					// md5 encrypted
					$password = hash('sha256', $_POST['password']);
					$conn->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
					// Check if username or email already exists in the database
					$stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = :username OR `email` = :email");
					$stmt->bindParam(':username', $username);
					$stmt->bindParam(':email', $email);
					$stmt->execute();
					if ($stmt->rowCount() > 0) {
						// Store error message in a session variable
						$_SESSION['error_msg'] = "Username or email already exists, please choose a different one!";
						// Redirect to registration page
						header('location: ./register.php');
						exit();
					}else{
						// Insert new user into the database
						$sql = "INSERT INTO `users` (username, email, password) VALUES ('$username', '$email', '$password')";
						$conn->exec($sql);
						$_SESSION['message']=array("text"=>"User successfully created!","alert"=>"info");
						$conn = null;
						header('location: ./login.php');
					}
				}catch(PDOException $e){
					echo $e->getMessage();
				}
			}
		}else{
			// Store error message in a session variable
			$_SESSION['error_msg'] = "Please fill up the required fields!";
			// Redirect to registration page
			header('location: ./register.php');
		}
	}
	
?>
