<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {

    ?>

    <!DOCTYPE html>
    <html>
    <head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="styles_login.css">
    </head>
    <body>

     <h1>Hello, colin</h1>

     <a href="logout.php">Logout</a>

    </body>
    </html>

    <?php 

}
else{
     header("Location: index.php");
     exit();
}

 ?>