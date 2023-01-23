<?php
/* this file is one folder higher on the server than the other files to prevent people from
 accessing it. */
 
$username = "daank";
$password = "bWbkWfCXuNAqbWAtBvPTINkMHQqIjzwG";

try {
    $conn = new PDO( 'mysql:host=localhost;dbname=life_below_water', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Connection Failed" .$e->getMessage();
}
?>
