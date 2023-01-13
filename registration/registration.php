<?php 
session_start(); 
include "db_connect.php";

if (isset($_POST['email']) && isset($_POST['user_name']) && isset($_POST['password'])) {

    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
}

$email = validate($_POST['email']);
$uname = validate($_POST['user_name']);
$password = validate($_POST['password']);

if (empty($email)) {
    header("Location: index.php?error=Email required");
    exit();
}
    
$sql = "SELECT * FROM users WHERE email='$email'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['email'] === $email) {
        header("Location: index.php?error=User already exists");
        exit();
    } else {
        header("Location: index.php?error=something went wrong");
        exit();
    }
} else {

    $sql = "INSERT INTO users (email, user_name, password)
            VALUES ($email, $uname, $password)"

    header("Location: home_registration.php");
    exit();
}   
?>