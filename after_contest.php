<?php
session_start(); 
  require"db.php";

  $correct_answers = 0;
  $wrong_answers = 0;
  $time_limit_exceeded = 0;
	for ($i=0; $i < $_SESSION["nquestions"]; $i++)
	{ 
		if($_SESSION["result"][$i] == "Correct Answer")
			$correct_answers++;
		else if($_SESSION["result"][$i] == "Wrong Answer")
			$wrong_answers++;
		else $time_limit_exceeded++;

		if($_SESSION["result"][$i] != "Correct Answer" and $_SESSION["result"][$i] != "Wrong Answer")
			$_SESSION["result"][$i] = "Time Limit Exceeded";
		$submission_path = "submissions/".$_SESSION["contest_id"]."_".$_SESSION["problem_id"][$i].".txt";

		$sql = "INSERT INTO submissions(username, contest_id, problem_id, submission_path, submission_date, status, problem_title) VALUES('".$_SESSION["username"]."', ".$_SESSION["contest_id"].", ".$_SESSION["problem_id"][$i].", '".$submission_path."', CURDATE(), '".$_SESSION["result"][$i]."', '".$_SESSION["title"][$i]."')";
		 if(!$result = $conn->query($sql))
		 	echo "Error while inserting in submissions";

		$sql = "INSERT INTO contest_problems(contest_id, problem_id, status, submission) VALUES(".$_SESSION["contest_id"].", ".$_SESSION["problem_id"][$i].", '".$_SESSION["result"][$i]."', '".$submission_path."')";
		 if($result = $conn->query($sql))
		 	echo "No Error while inserting in contest_problems";
		 else echo("Error description: " . mysqli_error($conn));
	}

	$sql = "UPDATE user SET correct_answers = correct_answers + ".$correct_answers.", wrong_answers = wrong_answers + ".$wrong_answers.", time_limit_exceeded = time_limit_exceeded + ".$time_limit_exceeded."";
	 if(!$result = $conn->query($sql))
	 		echo "Error while updating user";
	 else echo "jai hind";

	header("Location: home.php");

?>