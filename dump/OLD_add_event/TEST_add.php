<?php
$servername = "localhost";
$username = "daank";
$password = "bWbkWfCXuNAqbWAtBvPTINkMHQqIjzwG";
$dbname = "test_db";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO events (name, date, location, description, url)
  VALUES ('test2', '2023-01-17', 'Europe', 'test_description', 'www.events.com')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully \n";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?> 