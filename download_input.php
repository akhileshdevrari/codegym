<?php
session_start(); 
  require"db.php";
  $_SESSION["downloaded"][$_SESSION["num_id"]] = 1;
$filename = "input/".$_SESSION["problem_id"][$_SESSION["num_id"]].".txt'";
header('Content-Disposition: attachment; filename=' . basename($filename) . '"');
header("Content-type: text/plain");
header('Content-Length: ' . filesize($filename));
readfile($filename);
header("Location: contest.php");
?>