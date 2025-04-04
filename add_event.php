<?php
session_start();

if (file_exists('../connection.php')) {
    require('../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: index.php");
    exit();
}

if(isset($_POST['add_event']))
{
    // for table 'events'
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $url = $_POST['url'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    $query = "INSERT INTO events (name, date, description, url, country, city, address) 
    VALUES (:name, :date, :description, :url, :country, :city, :address)";
    $query_run = $conn->prepare($query);
    
    //prepare the data
    $data = [
        ':name' => $name,
        ':date' => $date,
        ':description' => $description,
        ':url' => $url,
        ':country' => $country,
        ':city' => $city,
        ':address' => $address
    ];
    $query_execute = $query_run->execute($data);

    // get the eventid of the current event to correctly enter the subjects and audiences
    // into the seperate tables
    $eventid = $conn->lastInsertId();

    // for table event_subjects
    $subjects = array("Acidification", "Eutrophication", "Overfishing", "Pollution", "Rising_Temperatures");
    foreach($subjects as $subject) {
        if (isset($_POST[$subject])) {
            $subject = $_POST[$subject];
            $query = "INSERT INTO event_subjects (eventid, subject) VALUES (:eventid, :subject)";
            $query_run = $conn->prepare($query);
            $data = [
                ':eventid' => $eventid,
                ':subject' => $subject,
            ];
            $query_execute = $query_run->execute($data);
        }
    }

    // for table event_audience
    $audiences = array("Academics", "Policy_Makers", "Environmentalists", "Concerned_Citizens", "Students");
    foreach($audiences as $target_audience) {
        if (isset($_POST[$target_audience])) {
            $target_audience = $_POST[$target_audience];
            $query = "INSERT INTO event_audience (eventid, target_audience) VALUES (:eventid, :target_audience)";
            $query_run = $conn->prepare($query);
            $data = [
                ':eventid' => $eventid,
                ':target_audience' => $target_audience,
            ];
            $query_execute = $query_run->execute($data);
        }
    }
}

header("location: index.php")
?>