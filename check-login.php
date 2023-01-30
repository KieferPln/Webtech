<!-- checks if the user is logged in -->
<?php
    session_start();
    if (isset($_SESSION['username'])) {
        echo json_encode(array('loggedIn' => true));
    } else {
        echo json_encode(array('loggedIn' => false));
    }
?>
