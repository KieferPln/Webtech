<?php
    session_start();
    // login check to determine whether the favorite-button should be shown
    // in the agenda
    if (isset($_SESSION['username'])) {
        $result['loggedIn'] = true;
        if ($_SESSION['user'] == '1') {
            $result['isAdmin'] = true;
        } else {
            $result['isAdmin'] = false;
        }
    }
    echo json_encode($result);
?>
