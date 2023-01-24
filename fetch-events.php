<?php
require('./connection.php');
session_start();
$sql = $conn->prepare('SELECT * FROM events');
$sql->execute();
$fetch = $sql->fetchAll();
echo json_encode($fetch)
?>
