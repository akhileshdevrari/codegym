<?php
		$servername = "localhost";
		$username = "root";
		$password = "idiox@0";
		$dbname = "codegym";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if($conn->connect_error)
		{
			die("Error connecting to database: ".$conn->connect_error);
		}
?>
