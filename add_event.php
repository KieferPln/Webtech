<?php
session_start();
require_once('../connection.php');

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
    $subjects = array("acidification", "eutrophication", "overfishing", "pollution", "rising_temperatures");
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

    /*if (isset($_POST['acidification'])) {
        $subject = 'acidification'; 
        $query2 = "INSERT INTO event_subjects (eventid, subject) VALUES (:eventid, :subject)";
        $query_run2 = $conn->prepare($query2);
        $data2 = [
            ':eventid' => $eventid,
            ':subject' => $subject,
        ];
        $query_execute2 = $query_run2->execute($data2);
    }  

    if (isset($_POST['eutrophication'])) {
        $subject = 'eutrophication'; 
        $query2 = "INSERT INTO event_subjects (eventid, subject) VALUES (:eventid, :subject)";
        $query_run2 = $conn->prepare($query2);
        $data2 = [
            ':eventid' => $eventid,
            ':subject' => $subject,
        ];
        $query_execute2 = $query_run2->execute($data2);
    }  

    if (isset($_POST['overfishing'])) {
        $subject = 'overfishing'; 
        $query2 = "INSERT INTO event_subjects (eventid, subject) VALUES (:eventid, :subject)";
        $query_run2 = $conn->prepare($query2);
        $data2 = [
            ':eventid' => $eventid,
            ':subject' => $subject,
        ];
        $query_execute2 = $query_run2->execute($data2);
    }  

    if (isset($_POST['pollution'])) {
        $subject = 'pollution'; 
        $query2 = "INSERT INTO event_subjects (eventid, subject) VALUES (:eventid, :subject)";
        $query_run2 = $conn->prepare($query2);
        $data2 = [
            ':eventid' => $eventid,
            ':subject' => $subject,
        ];
        $query_execute2 = $query_run2->execute($data2);
    } 

    if (isset($_POST['rising_temperatures'])) {
        $subject = 'rising_temperatures'; 
        $query2 = "INSERT INTO event_subjects (eventid, subject) VALUES (:eventid, :subject)";
        $query_run2 = $conn->prepare($query2);
        $data2 = [
            ':eventid' => $eventid,
            ':subject' => $subject,
        ];
        $query_execute2 = $query_run2->execute($data2);
    }  
    */


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

    /*
    if (isset($_POST['academics'])) {
        $target_audience = 'academics'; 
        $query2 = "INSERT INTO event_audience (eventid, target_audience) VALUES (:eventid, :target_audience)";
        $query_run2 = $conn->prepare($query2);
        $data2 = [
            ':eventid' => $eventid,
            ':target_audience' => $target_audience,
        ];
        $query_execute2 = $query_run2->execute($data2);
    }  

    if (isset($_POST['policy_makers'])) {
        $target_audience = 'policy_makers'; 
        $query2 = "INSERT INTO event_audience (eventid, target_audience) VALUES (:eventid, :target_audience)";
        $query_run2 = $conn->prepare($query2);
        $data2 = [
            ':eventid' => $eventid,
            ':target_audience' => $target_audience,
        ];
        $query_execute2 = $query_run2->execute($data2);
    }  

    if (isset($_POST['environmentalists'])) {
        $target_audience = 'environmentalists'; 
        $query2 = "INSERT INTO event_audience (eventid, target_audience) VALUES (:eventid, :target_audience)";
        $query_run2 = $conn->prepare($query2);
        $data2 = [
            ':eventid' => $eventid,
            ':target_audience' => $target_audience,
        ];
        $query_execute2 = $query_run2->execute($data2);
    }  

    if (isset($_POST['concerned_citizens'])) {
        $target_audience = 'concerned_citizens'; 
        $query2 = "INSERT INTO event_audience (eventid, target_audience) VALUES (:eventid, :target_audience)";
        $query_run2 = $conn->prepare($query2);
        $data2 = [
            ':eventid' => $eventid,
            ':target_audience' => $target_audience,
        ];
        $query_execute2 = $query_run2->execute($data2);
    }  

    if (isset($_POST['students'])) {
        $target_audience = 'students'; 
        $query2 = "INSERT INTO event_audience (eventid, target_audience) VALUES (:eventid, :target_audience)";
        $query_run2 = $conn->prepare($query2);
        $data2 = [
            ':eventid' => $eventid,
            ':target_audience' => $target_audience,
        ];
        $query_execute2 = $query_run2->execute($data2);
    }  
    */


}

header("location: index.php")
?>