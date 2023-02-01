<?php
session_start();

if (file_exists('../connection.php')) {
    require('../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: index.php");
    exit();
}

if(isset($_POST['eventid']))
{
    $eventid = $_POST['eventid'];
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