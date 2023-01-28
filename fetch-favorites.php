<?php
session_start();
require('../connection.php');
$username = $_SESSION['username'];
$sql = $conn->prepare("SELECT eventid FROM favorites WHERE username = '$username' ");
$sql->execute();
$fetch = $sql->fetchAll();
echo json_encode($fetch)
?>