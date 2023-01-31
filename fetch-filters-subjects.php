<?php

session_start();


if (file_exists('../connection.php')) {
    require('../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: index.php");
    exit();
}

$sql = $conn->prepare('SELECT event_subjects.id FROM event_subjects WHERE event_subjects.subject = :filterSubjects');
$sql->bindValue(':filterSubjects', $_COOKIE['filter_subjects']);
$sql->execute();
$EventSubjectIDs = $sql->fetchAll(PDO::FETCH_COLUMN);

if (!empty($EventSubjectIDs)) {
    $EventSubjectIDs = implode(',', $EventSubjectIDs);
    $sql = $conn->prepare('SELECT * FROM events WHERE events.eventid in (:EventSubjectIDs) AND events.date >= CURDATE() ORDER BY events.date ASC');
    $sql->bindValue(':EventSubjectIDs', $EventSubjectIDs);
    $sql->execute();
    $fetch = $sql->fetchAll();
    echo json_encode($fetch);
    }

else {
    echo "There are no events with these filters";
}
?>