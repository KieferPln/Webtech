<?php
session_start();

if (file_exists('../connection.php')) {
    require('../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: index.php");
    exit();
}

if(isset($_POST['name']))
{
    // for table 'events'
    $eventid = $_POST['eventid'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $url = $_POST['url'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];

    $query = "UPDATE events SET name=:name, date=:date, description=:description, url=:url, country=:country, city=:city, address=:address WHERE eventid = :eventid ";
    
    $query_run = $conn->prepare($query);

    // statement preparation
    $data = [
        ':eventid' => $eventid,
        ':name' => $name,
        ':date' => $date,
        ':description' => $description,
        ':url' => $url,
        ':country' => $country,
        ':city' => $city,
        ':address' => $address
    ];
    $query_execute = $query_run->execute($data);

    if (!$query_run->execute($data)) {
        $error = $query_run->errorInfo();
        echo "Error updating event: " . $error[2];
    } else {
        echo "Event updated successfully!";
    }

    // for table event_subjects. delete the entry first and enter the new ones
    $delete_query = "DELETE FROM event_subjects WHERE eventid = :eventid";
    $delete_statement = $conn->prepare($delete_query);
    $delete_statement->bindValue(':eventid', $eventid);
    $delete_statement->execute();
    
    // array to prevent malicious users
    $subjects = array("Acidification", "Eutrophication", "Overfishing", "Pollution", "Rising_Temperatures");
    // loop over the subjects and insert them if the box is checked
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

    //for table event_audience
    $delete_query = "DELETE FROM event_audience WHERE eventid = :eventid";
    $delete_statement = $conn->prepare($delete_query);
    $delete_statement->bindValue(':eventid', $eventid);
    $delete_statement->execute();

    $audiences = array("Academics", "Policy_Makers", "Environmentalists", "Concerned_Citizens", "Students");
    // loop in the same way as with subjects
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