<?php

$username = "daank";
$password = "bWbkWfCXuNAqbWAtBvPTINkMHQqIjzwG";

try {

    $conn = new PDO( 'mysql:host=localhost;dbname=test_db', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

    echo "Connection Failed" .$e->getMessage();
}

?>
