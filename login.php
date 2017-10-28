<?php
	session_start();
	require "db.php";
	$sql = "SELECT username, password FROM user WHERE username = '".$_POST["username"]."'";
	$result = $conn->query($sql);
	
	$row = $result->fetch_assoc();
	if($result->num_rows == 1 and password_verify($_POST["password"], $row["password"]))
	{
		$_SESSION["username"] = $row["username"];
		header('Location: ./home.php');
	}
	
	else
	{
		$_SESSION["loginerr"] = "Incorrect username or password :(";
		header('Location: ./index.php');
		exit;
	}
?>