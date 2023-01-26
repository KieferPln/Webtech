<?php
require('../connection.php');
session_start();
$sql = $conn->prepare('SELECT * FROM event_subjects');
$sql->execute();
$fetch = $sql->fetchAll();
echo json_encode($fetch)
?>