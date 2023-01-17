<?php
session_start();
include('connection.php');

if(isset($_POST['add_new_event']))
{
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $url = $_POST['url'];
    $location = $_POST['location'];

    $query = "INSERT INTO events (name, date, description, url, location) 
    VALUES (:name, :date, :description, :url, :location)";
    $query_run = $conn->prepare($query);

    $data = [
        ':name' => $name,
        ':date' => $date,
        ':description' => $description,
        ':url' => $url,
        ':location' => $location,
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
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