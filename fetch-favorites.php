<?php
session_start();

if (file_exists('../connection.php')) {
    require('../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];
$sql = $conn->prepare("SELECT eventid FROM favorites WHERE username = '$username' ");
$sql->execute();
$fetch = $sql->fetchAll();
echo json_encode($fetch)
?>