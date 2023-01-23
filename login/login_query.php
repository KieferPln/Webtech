<?php
	session_start();
 
	require_once '../connection.php';
 
	if(ISSET($_POST['login'])){
		if($_POST['username'] != "" || $_POST['password'] != ""){
			$username = $_POST['username'];
			$password = hash('sha256', $_POST['password']);
			$sql = "SELECT * FROM `users` WHERE `username`=? AND `password`=? ";
			$query = $conn->prepare($sql);
			$query->execute(array($username,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if($row > 0) {
				$_SESSION['user'] = $fetch['id'];
				header("location: home.php");
			} else{
			// Store error message in a session variable
			$_SESSION['error_msg'] = "Invalid username or password!";
			// Redirect to registration page
			header('location: index.php');
			}
		}else{
			// Store error message in a session variable
			$_SESSION['error_msg'] = "Please fill up the required fields!";
			// Redirect to registration page
			header('location: index.php');
		}
	}
?>