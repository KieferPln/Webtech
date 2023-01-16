<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'><link rel="stylesheet" href="./styles_login.css">

</head>
<body>
<form action="login.php" method="post">
<?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
<div class="login-form">
  
    <h1>Fill in your username and password:</h1>
    
    <div class="content">
      <div class="input-field">
        <input type="text" name="uname" placeholder="Username" autocomplete="nope">
      </div>
      <div class="input-field">
        <input type="password" name="password" placeholder="Password" autocomplete="new-password">
      </div>
      <a href="#" class="link">Forgot Your Password?</a>
    </div>
    <div class="action">
      <button type="button" onclick="location.href='/~kieferp/Webtech/registration/';" style="text-decoration:none;">Register</button>
      <button type="submit">Sign in</button>
    </div>
  </form>
</div>

<script  src="./script.js"></script>

</body>
</html>
