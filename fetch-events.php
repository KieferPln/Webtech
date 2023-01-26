<?php
require('../connection.php');
session_start();
$sql = $conn->prepare('SELECT * FROM events WHERE events.date >= CURDATE() ORDER BY events.date ASC');
$sql->execute();
$fetch = $sql->fetchAll();
echo json_encode($fetch)
?>
