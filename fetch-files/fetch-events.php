<?php

if (file_exists('../../connection.php')) {
    require('../../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: ../index.php");
    exit();
    
}session_start();
$sql = $conn->prepare('SELECT * FROM events WHERE events.date >= CURDATE() ORDER BY events.date ASC');
$sql->execute();
$fetch = $sql->fetchAll();

if (!empty($events)) {
    echo json_encode($events);
} else {
    echo json_encode(array("message" => "There are currently no upcomming events"));
}


?>
