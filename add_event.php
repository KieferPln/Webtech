<?php
session_start();
include('connection.php');

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
    if (isset($_POST['acidification'])) {
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

    // for table event_audience
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

    /*
    // for table 'event_locations'
    $eventid = $conn->lastInsertId();
    $africa = $_POST['africa'];
    $antarctica = $_POST['antarctica'];
    $asia = $_POST['asia'];
    $north_america = $_POST['north_america'];
    $europe = $_POST['europe'];
    $oceania = $_POST['oceania'];
    $south_america = $_POST['south_america'];

    $query2 = "INSERT INTO event_locations (eventid, africa, antarctica, asia, europe, north_america, oceania, south_america) 
    VALUES (:eventid, :africa, :antarctica, :asia, :europe, :north_america, :oceania, :south_america)";
    $query_run2 = $conn->prepare($query2);

    $data2 = [
        ':eventid' => $eventid,
        ':africa' => $africa,
        ':antarctica' => $antarctica,
        ':asia' => $asia,
        ':europe' => $europe,
        ':north_america' => $north_america,
        ':oceania' => $oceania,
        ':south_america' => $south_america,

    ];
    $query_execute2 = $query_run2->execute($data2);

    // for table 'event_subjects'
    $pollution = $_POST['pollution'];
    $acidification = $_POST['acidification'];
    $eutrophication = $_POST['eutrophication'];
    $overfishing = $_POST['overfishing'];
    $rising_temperatures = $_POST['rising_temperatures'];

    $query3 = "INSERT INTO event_subjects (eventid, acidification, eutrophication, overfishing, pollution, rising_temperatures) 
    VALUES (:eventid, :acidification, :eutrophication, :overfishing, :pollution, :rising_temperatures)";
    $query_run3 = $conn->prepare($query3);

    $data3 = [
        ':eventid' => $eventid,
        ':acidification' => $acidification,
        ':eutrophication' => $eutrophication,
        ':overfishing' => $overfishing,
        ':pollution' => $pollution,
        ':rising_temperatures' => $rising_temperatures,
        
    ];
    $query_execute3 = $query_run3->execute($data3);
    */

    /*
    if($query_execute and $query_execute2 and $query_execute3)
    {
        $_SESSION['message'] = "Inserted Successfully";
        header('Location: add_event.php');
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Not Inserted";
        header('Location: add_event.php');
        exit(0);
    }
    */
}

?>