<?php
$username = "daank";
$password = "bWbkWfCXuNAqbWAtBvPTINkMHQqIjzwG";
$conn = new PDO( 'mysql:host=localhost;dbname=test_db', $username, $password);
if(!$conn){
    die("Error: Connection Failed!");
}
?>