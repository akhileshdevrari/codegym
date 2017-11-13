<?php
	session_start(); 
	require"db.php";

	function verify()
	{
		$file_a = "submissions/".$_SESSION["contest_id"]."_".$_SESSION["problem_id"][$_SESSION["num_id"]].".txt";
		$file_b = $file = "output/".$_SESSION["problem_id"][$_SESSION["num_id"]].".txt";
	    if (filesize($file_a) == filesize($file_b))
	        if(sha1_file($file_a) == sha1_file($file_b))
	        	if(md5_file($file_a) == md5_file($file_b))
	        		return true;

	    return false;
	}



	// echo "Upload: " . $_FILES["submission"]["name"] . "<br>";
	// echo "Type: " . $_FILES["submission"]["type"] . "<br>";
	// echo "Size: " . ($_FILES["submission"]["size"] / 1024) . " kB<br>";
	// echo "Stored in: " . $_FILES["submission"]["tmp_name"]."<br>";

	// // store file content as a string in $str
	// $str = file_get_contents($_FILES["submission"]["tmp_name"]);
	// echo($str."<br><br>");




	$_SESSION["downloaded"][$_SESSION["num_id"]] = 1;
	$file = "submissions/".$_SESSION["contest_id"]."_".$_SESSION["problem_id"][$_SESSION["num_id"]].".txt";
	// echo "file path = ".$file."<br><br>";
	// var_dump($_SESSION["result"][$_SESSION["num_id"]]);
	// echo "<br><br>";
	//print_r($_FILES['submission']);
	// echo "<br><br>";
	if(!file_exists($_FILES['submission']['tmp_name']) || !is_uploaded_file($_FILES['submission']['tmp_name'])) {
        $_SESSION["result"][$_SESSION["num_id"]] = "Time Limit Exceeded";
        //echo "jai hind";
        header("Location: contest.php");
	}

	else
	{
		if ($_FILES['submission']['type'] != 'text/plain')
		{
			$_SESSION["result"][$_SESSION["num_id"]] = "Invalid File type";
			header("Location: contest.php");
		}
		if ($_FILES["submission"]["size"] > 500000) 
		{
	    	$_SESSION["result"][$_SESSION["num_id"]] = "Submitted file is too large";
	    	header("Location: contest.php");
		}

		if (!move_uploaded_file($_FILES["submission"]["tmp_name"], $file))
		 	$_SESSION["result"] = "Error while uploading file";
		else
		{
		 	if(verify())
		 	{
		 		$_SESSION["result"][$_SESSION["num_id"]] = "Correct Answer";
		 		$_SESSION["final_score"]++;
		 	}
		 	else 
		 		$_SESSION["result"][$_SESSION["num_id"]] = "Wrong Answer";
		}
		//echo "yo man<br><br>";
		//var_dump($_SESSION["result"][$_SESSION["num_id"]]);
		header("Location: contest.php");
	}

?>