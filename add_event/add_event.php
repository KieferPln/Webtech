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

    $query = "INSERT INTO events (name, date, description, url) 
    VALUES (:name, :date, :description, :url)";
    $query_run = $conn->prepare($query);

    $data = [
        ':name' => $name,
        ':date' => $date,
        ':description' => $description,
        ':url' => $url,
    ];
    $query_execute = $query_run->execute($data);

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
}

?>