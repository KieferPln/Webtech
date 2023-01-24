<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Life Below Water: Log In</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stijles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/var/www/html/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/var/www/html/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
</head>

<body>
    <div class="container">
        <canvas style="z-index:0;" id="canvas"></canvas>
        <div style="z-index:1;">
            <div class="alert-success" id="success_msg" style="display:
            <?php if(isset($_SESSION['message'])) echo 'block'; else echo 'none'; ?>;">
            <?php if(isset($_SESSION['message'])) echo $_SESSION['message']['text']; unset($_SESSION['message']);?>
            </div>
            <div class="alert-danger" id="error_msg" style="display:
            <?php if(isset($_SESSION['error_msg'])) echo 'block'; else echo 'none'; ?>;">
            <?php if(isset($_SESSION['error_msg'])) echo $_SESSION['error_msg']; unset($_SESSION['error_msg']);?>
            </div>
                <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg"><?php echo $_SESSION['message']['text'] ?></div> 
            <script>
                (function () {
                    // removing the message 3 seconds after the page load
                    setTimeout(function () {
                        document.querySelector('.msg').remove();
                    }, 3000)
                })();
            </script>
            <?php 
                    endif;
                    // clearing the message
                    unset($_SESSION['message']);
            ?>
            <form action="login_query.php" method="POST">
                <p
                    style=" border-bottom: 1px solid rgb(239, 239, 239); padding-bottom: .5em; padding-left: .2em ; font-weight: 500;">
                    Log In</p>
				    <input type="text" placeholder="Username" name="username" />
				    <input type="password" placeholder="Password" name="password" />
                <div class="button-container">
                    <button id="sign-in" name="login">Sign In</button>
                    <div id="buttons">
                        <p>Don't have an account? </p>
                        <a href="./register.php" id="sign-up">
                            Sign Up
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="background.js"></script>
</body>
</html>