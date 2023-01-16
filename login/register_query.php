<?php
	session_start();
	require_once 'opendb.php';
 
	if(ISSET($_POST['register'])){
		if($_POST['username'] != "" || $_POST['email'] != "" || $_POST['password'] != ""){
			try{
				$username = mysql_real_escape_string($conn, htmlspecialchars($_POST['username']));
				$email = mysql_real_escape_string($conn, htmlspecialchars($_POST['email']));
				// md5 encrypted
				$password = mysql_real_escape_string($conn, htmlspecialchars(md5($_POST['password'])));
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO `users` (username, email, password) VALUES ('$username', '$email', '$password')";
				$conn->exec($sql);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			$_SESSION['message']=array("text"=>"User successfully created.","alert"=>"info");
			$conn = null;
			header('location:index.php');
		}else{
			echo "
				<script>alert('Please fill up the required field!')</script>
				<script>window.location = 'registration.php'</script>
			";
		}
	}
?>
