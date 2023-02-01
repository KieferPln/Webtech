<?php
session_start();

if (file_exists('../connection.php')) {
    require('../connection.php');
} else {
    $_SESSION['database-error'] = "Failed to connect to database.";
    header("Location: index.php");
    exit();
}

$id = $_SESSION['user'];
$eventid = $_POST['eventid'];

try {    
    // check if the event is in the user's favorites
    $check_favorite = $conn->prepare("SELECT * FROM favorites WHERE id = :id AND eventid = :eventid");
    $check_favorite->bindParam(':id', $id);
    $check_favorite->bindParam(':eventid', $eventid);
    $check_favorite->execute();
    $result = $check_favorite->fetch();
    
    // delete it from the table if it is
    if($result){
        $delete_favorite = $conn->prepare("DELETE FROM favorites WHERE id = :id AND eventid = :eventid");
        $delete_favorite->bindParam(':id', $id);
        $delete_favorite->bindParam(':eventid', $eventid);
        $delete_favorite->execute();
        echo json_encode("deleted");
    }
    // add it to the table if it isn't
    else {
        $add_favorite = $conn->prepare("INSERT INTO favorites (id, eventid) VALUES (:id, :eventid)");
        $add_favorite->bindParam(':id', $id);
        $add_favorite->bindParam(':eventid', $eventid);
        $add_favorite->execute();
        echo json_encode("added");
    }
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}