<?php
	session_start();
	require_once('../../connection.php');

	// Start of the database entry
	if(ISSET($_POST['change_email'])){
		if($_POST['new_email'] != $_POST['new_email_repeat']){
			$_SESSION['error_message'] = "The addresses you entered don't match.";
				// Redirect to previous page
				header('location: change_email.php');
		}
        else{    
            $username = $_SESSION['username'];
            $email = $_POST['new_email'];
            $conn->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Check if username or email already exists in the database
            $stmt = $conn->prepare("UPDATE `users` SET `email` = :email WHERE `username` = :username");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
			$_SESSION['succes_message'] = "Address succesfully changed.";
            header('location: change_email.php');
            }
        }
    

?>