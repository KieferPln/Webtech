<?php
session_start();
include('connection.php');

if(isset($_POST['add_to_favorite']))
{
    $eventid = $_POST['eventid'];
    $userid = $_POST['userid'];


    $query = "INSERT INTO favorites (eventid, userid)
    VALUES (:int, :int)";
    $query_run = $conn->prepare($query);

    $data = [
        ':int' => $eventid,
        ':int' => $userid,
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
    {
        $_SESSION['message'] = "Inserted Successfully";
        header('Location: add_favorite.php');
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Not Inserted";
        header('Location: add_favorite.php');
        exit(0);
    }
}

?>
