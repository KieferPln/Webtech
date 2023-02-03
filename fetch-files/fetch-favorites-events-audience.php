<?php
session_start();

if (file_exists('../../connection.php')) {
    require('../../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: ../index.php");
    exit();
}

$sql = $conn->prepare('SELECT events.* FROM events JOIN event_audience ON events.eventid = event_audience.eventid JOIN favorites ON events.eventid = favorites.eventid WHERE event_audience.target_audience = :audience AND favorites.id = :id AND events.date >= CURDATE() ORDER BY events.date ASC');
$sql->bindValue(':id', $_SESSION['user']);
$sql->bindValue(':audience', $_COOKIE['filter_audience']);
$sql->execute();
$events = $sql->fetchAll();

header('Content-Type: application/json');

if (!empty($events)) {
    echo json_encode($events);
} elseif (isset($_SESSION['username'])){
    echo json_encode(array("message" => "You have no favorites with this target audience"));
} else {
    echo json_encode(array("message" => "You need to be logged in to view your favorites"));
}
?>