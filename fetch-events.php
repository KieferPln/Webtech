<?php
require('./connection.php');
session_start();
$id = $_SESSION['user'];
$sql = $conn->prepare("SELECT * FROM `events`");
$sql->execute();
$fetch = $sql->fetch();
echo ($fetch)
    ?>