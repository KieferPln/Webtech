<?php
session_start();
require('../connection.php');

$eventid = $_GET["eventid"];

$query = "SELECT * FROM events WHERE eventid = :eventid";
$query_run = $conn->prepare($query);
$query_run->execute([':eventid' => $eventid]);
$result = $query_run->fetch(PDO::FETCH_ASSOC);

if ($result) {
  $name = $result['name'];
  $date = $result['date'];
  $description = $result['description'];
  $url = $result['url'];
  $country = $result['country'];
  $city = $result['city'];
  $address = $result['address'];
} else {
  // error handling
}

$subjects_query = "SELECT subject FROM event_subjects WHERE eventid = :eventid";
$subjects_query_run = $conn->prepare($subjects_query);
$subjects_query_run->execute([':eventid' => $eventid]);
$subjects_result = $subjects_query_run->fetchAll(PDO::FETCH_COLUMN);

$audience_query = "SELECT target_audience FROM event_audience WHERE eventid = :eventid";
$audience_query_run = $conn->prepare($audience_query);
$audience_query_run->execute([':eventid' => $eventid]);
$audience_result = $audience_query_run->fetchAll(PDO::FETCH_COLUMN);

echo json_encode([
    'eventid' => $eventid,
    'name' => $name,
    'date' => $date,
    'description' => $description,
    'url' => $url,
    'country' => $country,
    'city' => $city,
    'address' => $address,
    'subjects' => $subjects_result,
    'audience' => $audience_result
  ]);

?>