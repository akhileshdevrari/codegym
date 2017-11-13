<?php
	session_start(); 
	require"db.php";

	print_r($_FILES['backend_input']);
	echo "<br>";
	print_r($_FILES['backend_output']);
	echo "<br>";
	$inputfile = $_FILES['backend_input'];
	$outputfile = $_FILES['backend_output'];

	$sql = "INSERT INTO problem(title, problem_statement, input_text, output_text, sample_input, sample_output, backend_input, backend_output, difficulty, author, tester) VALUES ('".$_POST["title"]."', '".nl2br($_POST["problem_statement"])."', '".nl2br($_POST["input_text"])."', '".nl2br($_POST["output_text"])."', '".nl2br($_POST["sample_input"])."', '".nl2br($_POST["sample_output"])."', '".$_POST["backend_input"]."', '".$_POST["backend_output"]."', '".$_POST["difficulty"]."', '".$_POST["author"]."', '".$_POST["tester"]."')";
	if ($conn->query($sql) === TRUE) 
	{
	    echo "successfully inserted into problem table<br>";
	} 
	else 
	{
	    echo "Error: " . $sql . "<br>" . $conn->error;
	    exit;
	}

	$sql = "SELECT problem_id FROM problem WHERE problem_id = LAST_INSERT_ID()";
	$result = $conn->query($sql); 
	$row = $result->fetch_assoc();
	$problem_id = $row["problem_id"];
	$target_input_file = "input/".$problem_id.".txt";
	$target_output_file = "output/".$problem_id.".txt";
	echo "<br><br> target_input_file = ".$target_input_file."<br><br>";
	echo "<br><br> target_output_file = ".$target_output_file."<br><br>";

	if (move_uploaded_file($inputfile["tmp_name"], $target_input_file)) {
        echo "The file ". basename( $inputfile["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
	if (move_uploaded_file($outputfile["tmp_name"], $target_output_file)) {
        echo "The file ". basename( $outputfile["backend_output"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    $sql = "UPDATE problem SET backend_input = '".$target_input_file."', backend_output = '".$target_output_file."' WHERE problem_id = ".$problem_id;
    if ($conn->query($sql) === TRUE) 
	{
	    echo "successfully set input/output path into problem table<br>";
	} 
	else 
	{
	    echo "Error: " . $sql . "<br>" . $conn->error;
	    exit;
	}



	$sql = "INSERT INTO tag SET problem_id = LAST_INSERT_ID(), tag_name = '".$_POST["tag"]."'";
	if ($conn->query($sql) === TRUE) 
	{
	    echo "successfully inserted into tag table<br>";
	} 
	else 
	{
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>