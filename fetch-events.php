<?php
require('../../connection.php');
session_start();
?>


<?php
$id = $_SESSION['user'];
$sql = $conn->prepare("SELECT * FROM `events`");
$sql->execute();
$fetch = $sql->fetch();
echo json_encode(42);
?>