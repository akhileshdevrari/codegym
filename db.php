<?php
		$servername = "localhost";
		$username = "root";
		$password = "mi";
		$dbname = "codegym";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if($conn->connect_error)
		{
			die("Error connecting to database: ".$conn->connect_error);
		}
?>