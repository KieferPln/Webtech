<?php
	$db_username = 'kieferp';
	$db_password = 'UkmtdEVlrYGOKYkGqeljPundaLYKpZin';
	$conn = new PDO( 'mysql:host=localhost;dbname=life_below_water', $db_username, $db_password );
	if(!$conn){
		die("Fatal Error: Connection Failed!");
	}
?>