<?php
require('../connection.php');
session_start();
$sql = $conn->prepare('SELECT * FROM event_audience');
$sql->execute();
$fetch = $sql->fetchAll();
echo json_encode($fetch)
?>