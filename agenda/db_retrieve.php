<!DOCTYPE html>

<!--
om van een specifiek event de informatie aan variabelen toe te wijzen is dit de sql query

SELECT @event_name := name, @event_date := date, @event_url := url, @event_location := location, 
@desc := description FROM events WHERE eventid = '@eventid';
-->

<?php
	require 'connection.php';
	session_start();
 
?>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			
		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">Retrieval of events from database</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<h3>Welcome!</h3>
			<br>
			<?php
            $stmt = $conn->prepare("SELECT name, description, url FROM events");
            $stmt->execute();
			$fetch = $stmt->fetch(); ?>
            <!-- //echo $fetch['username']." with email ". $fetch['email'] -->
            <center><h4><?php echo $fetch['name']." with url ". $fetch['url']?></h4></center>

            
            <!-- op deze manier achterhaal je onderwerpen/doelgroepen voor events. -->
            <?php 
            class TableRows extends RecursiveIteratorIterator {
            function __construct($it) {
                parent::__construct($it, self::LEAVES_ONLY);
            }};

            $stmt = $conn->prepare("SELECT eventid FROM event_audience WHERE target_audience = 'policy_makers' ");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            echo "De events met als onderwerp 'policy makers' zijn: <br> ";
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                echo $v;
                echo "<br>";
            }
            //$table = $stmt->fetchAll();
            //print_r($table);
             ?>

            
		</div>
	</div>
</body>
</html>
