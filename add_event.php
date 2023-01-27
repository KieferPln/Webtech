<?php
session_start();
require('../connection.php');

if(isset($_POST['add_new_event']))
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

    $eventid = $conn->lastInsertId();

    // for table event_subjects
    $subjects = array("Acidification", "Eutrophication", "Overfishing", "Pollution", "Rising Temperatures");
    foreach($subjects as $subject) {
        if (isset($_POST[$subject])) {
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
    $audiences = array("academics", "policy_makers", "environmentalists", "concerned_citizens", "students");
    foreach($audiences as $target_audience) {
        if (isset($_POST[$target_audience])) {
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