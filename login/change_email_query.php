<?php
	session_start();
	require_once('../../connection.php');

	// Start of the database entry
	if(ISSET($_POST['register'])){
		if($_POST['new_email'] != $_POST['new_email_repeat']){
			$_SESSION['error_msg'] = "The addresses you entered don't match.";
				// Redirect to previous page
				header('location: change_email.php');
		}
        else{
            try{
                $username = $_POST['username'];
                $new_email = $_POST['new_email'];
                $new_email_repeat = $_POST['new_email_repeat'];
                $conn->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                // Check if username or email already exists in the database
                $stmt = $conn->prepare("UPDATE users SET email = $email WHERE username == $username");
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
?>