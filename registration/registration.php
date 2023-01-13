<?php 
session_start(); 
include "db_connect.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
}

$uname = validate($_POST['uname']);
$pass = validate($_POST['password']);

if (empty($uname)) {
    header("Location: index.php?error=User Name is required");
    exit();
}
else if(empty($pass)) {
    header("Location: index.php?error=Password is required");
    exit();
}
    
$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass' AND email='$email'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['email'] === $email) {
        header("Location: index.php?error=User already exists");
        exit();
    }
    else {
        header("Location: home_registration.php");
        exit();
    }
}
else {
    header("Location: index.php?error=Incorect Username or password");
    exit();
}
?>