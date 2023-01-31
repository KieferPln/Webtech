<?php

session_start();

if (file_exists('../../connection.php')) {
    require('../../connection.php');
  } else {
    $_SESSION['error_message'] = "Failed to connect to database.";
    header("Location: change_password.php");
    exit();
  }

if(ISSET($_POST['change_password'])){
    // Check if all fields are filled in
    if($_POST['old_password'] != "" && $_POST['new_password'] != "" && $_POST['new_password_repeat'] != ""){
        // Check if new passwords match
        if($_POST['new_password'] == $_POST['new_password_repeat']){
            // Hash the entered passwords
            $old_password = hash('sha256', $_POST['old_password']);
            $new_password = hash('sha256', $_POST['new_password']);
            $username = $_SESSION['username'];

            // Check if entered old password matches the password in the database
            $sql = "SELECT * FROM `users` WHERE `username`=? AND `password`=? ";
            $query = $conn->prepare($sql);
            $query->execute(array($username,$old_password));
            $row = $query->rowCount();

            if($row > 0){
                // Update the password in the database
                $sql = "UPDATE `users` SET `password` = ? WHERE `username` = ?";
                $query = $conn->prepare($sql);
                $query->execute(array($new_password, $username));
                // Store success message in a session variable
                $_SESSION['succes_message'] = "Password successfully changed!";
                
                header('location: change_password.php');
                
            } else{
                // Store error message in a session variable
                $_SESSION['error_message'] = "Incorrect current password!";
                header('location: change_password.php');
            }
        
        }
        else {
            $_SESSION['error_message'] = "New passwords don't match!";
            header('location: change_password.php');
        }
    }
}
?>