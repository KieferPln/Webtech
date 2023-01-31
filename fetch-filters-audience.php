<?php

session_start();


if (file_exists('../connection.php')) {
    require('../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: index.php");
    exit();
}

$sql = $conn->prepare('SELECT event_audience.id FROM event_audience WHERE event_audience.target_audience = :filterAudience');
$sql->bindValue(':filterAudience', $_COOKIE['filter_audience']);
$sql->execute();
$EventAudienceIDs = $sql->fetchAll(PDO::FETCH_COLUMN);

if (!empty($EventAudienceIDs)) {
    $EventAudienceIDs = implode(',', $EventAudienceIDs);
    $sql = $conn->prepare('SELECT * FROM events WHERE events.eventid in (:EventAudienceIDs) AND events.date >= CURDATE() ORDER BY events.date ASC');
    $sql->bindValue(':EventAudienceIDs', $EventAudienceIDs);
    $sql->execute();
    $fetch = $sql->fetchAll();
    echo json_encode($fetch);
    }

else {
    echo "There are no events with these filters";
}
?>