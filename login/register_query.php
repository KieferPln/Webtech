<?php
	session_start();
	require_once('../../connection.php');
 
	// if(ISSET($_POST['register'])){
	// 	if($_POST['username'] != "" || $_POST['email'] != "" || $_POST['password'] != ""){
	// 		try{
	// 			$username = $_POST['username'];
	// 			$email = $_POST['email'];
	// 			// md5 encrypted
	// 			$password = hash('sha256', $_POST['password']);
	// 			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
	// 			// Check if username or email already exists in the database
	// 			$stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = :username OR `email` = :email");
	// 			$stmt->bindParam(':username', $username);
	// 			$stmt->bindParam(':email', $email);
	// 			$stmt->execute();
	// 			if ($stmt->rowCount() > 0) {
	// 				echo "
	// 					<script>alert('Username or email already exists, please choose a different one!')</script>
	// 					<script>window.location = 'registration.php'</script>
	// 				";
	// 				exit();
	// 			}
				
	// 			// Insert new user into the database
	// 			$sql = "INSERT INTO `users` (username, email, password) VALUES ('$username', '$email', '$password')";
	// 			$conn->exec($sql);
	// 		}catch(PDOException $e){
	// 			echo $e->getMessage();
	// 		}
	// 		$_SESSION['message']=array("text"=>"User successfully created.","alert"=>"info");
	// 		$conn = null;
	// 		header('location:index.php');
	// 	}else{
	// 		echo "
	// 			<script>alert('Please fill up the required field!')</script>
	// 			<script>window.location = 'registration.php'</script>
	// 		";
	// 	}
	// }
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
