<?php
$username = "daank";
$password = "bWbkWfCXuNAqbWAtBvPTINkMHQqIjzwG";
$conn = new PDO( 'mysql:host=localhost;dbname=test_db', $db_username, $db_password);
if(!$conn){
    die("Fatal Error: Connection Failed!");
    }
?>