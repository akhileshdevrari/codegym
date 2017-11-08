<?php
session_start();
require"db.php";
	$_SESSION["nquestions"] = $_POST["nquestions"];
	//echo $_SESSION["nquestions"];
	header("Location: contest.php");
	exit();
?>