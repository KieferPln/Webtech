<?php
	session_start();
 
	if (file_exists('../../connection.php')) {
		require('../../connection.php');
	} else {
		$_SESSION['database-error'] = "Failed to connect to database.";
		header("Location: ../index.php");
		exit();
	}
	
	if (isset($_POST['login'])) {
		if (!empty($_POST['username']) && !empty($_POST['password'])) {
			$username = $_POST['username'];
			$password = hash('sha256', $_POST['password']);
			$sql = "SELECT * FROM `users` WHERE `username` = :username AND `password` = :password";
			$query = $conn->prepare($sql);
			$query->bindParam(':username', $username);
			$query->bindParam(':password', $password);
			$query->execute();
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if ($row > 0) {
				$_SESSION['user'] = $fetch['id'];
				$_SESSION['username'] = $fetch['username'];
				header("location: ../index.php");
			} else {
				// Store error message in a session variable
				$_SESSION['error_msg'] = "Invalid username or password!";
				// Redirect to registration page
				header('location: login.php');
			}
		} else {
			// Store error message in a session variable
			$_SESSION['error_msg'] = "Please fill in the required fields!";
			// Redirect to registration page
			header('location: login.php');
		}
	}
?>