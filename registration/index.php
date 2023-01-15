<!DOCTYPE html>
<html lang="en" dir="ltr">
<html>
    <head>
        <title>registration page</title>
        <link rel="stylesheet" type="text/css" href="styles_regristration.css">
</head>
    <body>
        <div class="wrapper">
            <form action="registration.php" method="post">
            <h2>Register</h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <form action="#">
        <div class="input-box">
        <input type="text" placeholder="Enter your name" required>
        </div>
        <div class="input-box">
            <input type="text" placeholder="Enter your email" required>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Create password" required>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Confirm password" required>
        </div>
        <div class="input-box button">
            <input type="Submit" value="Register Now">
        </div>
        <div class="text">
            <h3>Already have an account? <a href="https://webtech-ki44.webtech-uva.nl/~kieferp/Webtech-2/login/">Login now</a></h3>
            </form>
        </div>
    </body>
</html>




