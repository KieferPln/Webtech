<?php
session_start();

if (file_exists('../connection.php')) {
    require('../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: index.php");
    exit();
}

$sql = $conn->prepare('SELECT events.* FROM events JOIN event_audience ON events.eventid = event_audience.eventid JOIN event_subjects ON events.eventid = event_subjects.eventid WHERE event_audience.target_audience = :audience AND event_subjects.subject = :subject AND events.date >= CURDATE() ORDER BY events.date ASC');
$sql->bindValue(':subject', $_COOKIE['filter_subjects']);
$sql->bindValue(':audience', $_COOKIE['filter_audience']);
$sql->execute();
$events = $sql->fetchAll();

header('Content-Type: application/json');

if (!empty($events)) {
    echo json_encode($events);
} else {
    echo json_encode(array("message" => "There are no events with this subject"));
}
?>