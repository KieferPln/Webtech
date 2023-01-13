<!DOCTYPE html>
<html>
<head>
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="styles_login.css">
</head>
<body>
    <h1 style="background-color:red">incorrect password or username</h1>
     <form action="login.php" method="post">
        <h2>LOGIN</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <label>Username</label>
        <input type="text" name="uname" placeholder="Username"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br> 
        <button type="submit">Login</button>
     </form>
</body>
</html>