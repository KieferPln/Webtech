<?php

if (file_exists('../connection.php')) {
    require('../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: index.php");
    exit();
    
}session_start();
$sql = $conn->prepare('SELECT * FROM event_audience');
$sql->execute();
$fetch = $sql->fetchAll();
echo json_encode($fetch)
?>