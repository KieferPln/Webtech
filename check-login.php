<?php
    session_start();
    // login check to determine whether the favorite-button should be shown
    // in the agenda
    if (isset($_SESSION['username'])) {
        echo json_encode(array('loggedIn' => true));
    } else {
        echo json_encode(array('loggedIn' => false));
    }
?>
