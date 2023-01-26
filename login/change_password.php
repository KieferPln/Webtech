<?php session_start(); ?>
<link rel="shortcut icon" type="image/x-icon" href="../favicon/favicon.ico">


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Life Below Water: Change Password</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stijles.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
</head>

<body>
    <div class="container">
        <canvas style="z-index:0;" id="canvas"></canvas>
        <div style="z-index:1;">
            <?php if(isset($_SESSION['succes_message'])): ?>
                <div class="alert-success">
                    <?php echo $_SESSION['succes_message']; ?>
                </div>
            <?php elseif(isset($_SESSION['error_message'])): ?>
                <div class="alert-danger">
                    <?php echo $_SESSION['error_message']; ?>
                </div>
            <?php 
                endif;
                // clearing the message
                unset($_SESSION['error_message']);
                unset($_SESSION['succes_message']);
            ?>
            <form action="change_password_query.php" method="POST">
                <p
                    style=" border-bottom: 1px solid rgb(239, 239, 239); padding-bottom: .5em; padding-left: .2em ; font-weight: 500;">
                    Change password</p>
				    <input type="password" placeholder="Old password" name="old_password" required/>
				    <input type="password" placeholder="New password" name="new_password" required/>
                    <input type="password" placeholder="Repeat new password" name="new_password_repeat" required/>
                <div class="button-container">
                    <button id="sign-in" name="change_password">Change password</button>
                    <div id="buttons">
                        <a href="../index.php" id="sign-up">
                            Return to homepage
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--<script src="background.js"></script>-->
</body>
</html>