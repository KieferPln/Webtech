<?php
session_start();
require('../connection.php');
$username = $_SESSION['username'];
$eventid = $_POST['eventid'];

try {
    $conn;
    
    // check if the event is in the user's favorites
    $check_favorite = $conn->prepare("SELECT * FROM favorites WHERE username = :username AND eventid = :eventid");
    $check_favorite->bindParam(':username', $username);
    $check_favorite->bindParam(':eventid', $eventid);
    $check_favorite->execute();
    $result = $check_favorite->fetch();
    
    // delete it from the table if it is
    if($result){
        $delete_favorite = $conn->prepare("DELETE FROM favorites WHERE username = :username AND eventid = :eventid");
        $delete_favorite->bindParam(':username', $username);
        $delete_favorite->bindParam(':eventid', $eventid);
        $delete_favorite->execute();
        echo json_encode("deleted");
    }
    // add it to the table if it isn't
    else {
        $add_favorite = $conn->prepare("INSERT INTO favorites (username, eventid) VALUES (:username, :eventid)");
        $add_favorite->bindParam(':username', $username);
        $add_favorite->bindParam(':eventid', $eventid);
        $add_favorite->execute();
        echo json_encode("added");
    }
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}