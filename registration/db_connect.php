<?php

    $localhost = "localhost";
    $uname = "kieferp";
    $password = "UkmtdEVlrYGOKYkGqeljPundaLYKpZin";
    $db_name = "test_db";
    $conn = mysqli_connect($localhost, $uname, $password, $db_name);

if (!$conn) {
    echo "Connection failed!";
}