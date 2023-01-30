<!--if log out button is clicked, destroy session and return to main page -->

<?php
session_start();
unset($_SESSION['username']);
session_destroy();
header('Location: index.php');
?>
