<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stijles.css">
    <title>Life Below Water: Sign Up</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
</head>

<body>

    <div class="container">
        <div class="alert-danger-register" id="error_msg" style="display:
		    <?php if(isset($_SESSION['error_msg'])) echo 'block'; else echo 'none'; ?>;">
		    <?php if(isset($_SESSION['error_msg'])) echo $_SESSION['error_msg']; unset($_SESSION['error_msg']);?>
		</div>
        <canvas style="z-index:0;" id="canvas"></canvas>
        <form style="z-index: 1;" action="register_query.php" method="POST">
            <p style="border-bottom: 1px solid rgb(239, 239, 239); padding-bottom: .5em; padding-left: .2em ;">
                Sign Up</p>

            <input type="username" placeholder="Username" name="username" maxlength="27"/>
            <input type="email" placeholder="Email" name="email"/>
            <input type="password" placeholder="Password" name="password"/>
            <input type="password" placeholder="Confirm Password" name="confirm_password"/>

            <div class="button-container">
                <button id="sign-in" name="register">Sign Up</button>

                <div id="buttons">
                    <p>Already have an account? </p>
                    <a href="./login.php" id="sign-up">
                        Log In
                    </a>
                </div>
                <div id="buttons">
                    <a href="../index.php" id="sign-up">
                        Return to homepage
                    </a>
                </div>
            </div>
        </form>
    </div>
    <script src="./background.js"></script>
</body>
</html>