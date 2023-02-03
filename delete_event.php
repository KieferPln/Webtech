<?php
session_start();

if (file_exists('../connection.php')) {
    require('../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: index.php");
    exit();
}
// eventid is only set when the event form is opened through 'edit event'
if(isset($_POST['eventid']))
{
    $eventid = $_POST['eventid'];
    // the eventid primary key is linked to event_subjects and event_audience.
    // deleting an event from the `events` table automatically deletes them elsewhere
    // so seperate queries aren't necessary
    $query = "DELETE FROM events WHERE eventid = :eventid ";
    $query_run = $conn->prepare($query);
    $query_execute = $query_run->execute([':eventid' => $eventid]);

    if (!$query_execute) {
        $error = $query_run->errorInfo();
        echo "Error updating event: " . $error[2];
    } else {
        echo "Event updated successfully!";
    }
}

header("location: index.php")
?>