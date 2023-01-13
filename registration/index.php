<!DOCTYPE html>
<html>
<head>
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="styles_registration.css">
</head>
<body>
     <form action="registration.php" method="post">
        <h2>Register</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>Email</label>
        <input type="text" name="email" placeholder="Email"><br>
        <label>Username</label>
        <input type="text" name="uname" placeholder="Username"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br> 
        <label>Repeat Password</label>
        <input type="password" name="password" placeholder="password"><br>
        <button type="submit">Register</button>
     </form>
</body>
</html>