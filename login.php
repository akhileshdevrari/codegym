<?php
	session_start();
	require "db.php";
	//echo "yo babe";
	$sql = "SELECT username, password FROM user WHERE username = '".$_POST["username"]."'";
	$result = $conn->query($sql);
	
	$row = $result->fetch_assoc();
	if($result->num_rows == 1 and password_verify($_POST["password"], $row["password"]))
	{
		$_SESSION["username"] = $row["username"];
		header('Location: ./home.php');
		//echo "input password = ".$_POST["password"]."  its hash is  ".password_hash($_POST["password"], PASSWORD_DEFAULT)."<br>";
		//echo "password in database is  ".$row["password"];
	}
	
	else
	{
		$_SESSION["loginerr"] = "Incorrect username or password :(";
		header('Location: ./index.php');
		//echo "nooooo";
		exit;
	}
?>