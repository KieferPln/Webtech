<?php
session_start();

if (file_exists('../../connection.php')) {
    require('../../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: ../index.php");
    exit();
}

$id = $_SESSION['user'];
$sql = $conn->prepare("SELECT eventid FROM favorites WHERE id = '$id' ");
$sql->execute();
$fetch = $sql->fetchAll();
echo json_encode($fetch)
?>