<?php

$username = "milant";
$password = "KYhbRInlBwLnBnwAkdedIhjLwjaPPgzL";

try {

    $conn = new PDO( 'mysql:host=localhost;dbname=life_below_water', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {

    echo "Connection Failed" .$e->getMessage();
}

?>

