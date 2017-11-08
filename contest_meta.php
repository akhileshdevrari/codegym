<?php 
  require"db.php";
  session_start();
  $_SESSION["num_id"] = $_GET["num_id"];
	header("Location: ./contest.php");
?>