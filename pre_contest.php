<?php
session_start();
require"db.php";
	$_SESSION["nquestions"] = $_POST["nquestions"];
	$_SESSION["duration"] = $_POST["duration"];
	$_SESSION["final_score"] = 0;

            	$nquestions = (int)$_SESSION["nquestions"];
                $_SESSION["num_id"] = 0;
                $_SESSION["problem_id"] = array();
                $_SESSION["title"] = array();
                $_SESSION["problem_statement"] = array();
                $_SESSION["input_text"] = array();
                $_SESSION["output_text"] = array();
                $_SESSION["sample_input"] = array();
                $_SESSION["sample_output"] = array();
                $_SESSION["tag"] = array();
                $_SESSION["difficulty"] = array();
                $_SESSION["score"] = array();
                $_SESSION["result"] = array();
                $_SESSION["downloaded"] = array();
                $_SESSION["count_start"] = array();
                $taken_problems = array();

            for($i = 0; $i<$nquestions; $i++)
            {
            	//echo $_POST["tag".$i]."     ".$_POST["difficulty".$i]."<br>";

                $sql = "SELECT * FROM problem
                        INNER JOIN tag ON tag.problem_id = problem.problem_id
                        WHERE tag.tag_name = '".$_POST["tag".($i+1)]."' AND problem.difficulty = '".$_POST["difficulty".($i+1)]."'
                        AND problem.problem_id NOT IN 
                            (
                                SELECT problem_id FROM submissions 
                                    WHERE username = '".$_SESSION["username"]."'
                                    AND status = 'Correct Answer'
                                UNION
                                SELECT problem_id FROM problem 
                                    WHERE problem_id IN ( '" . implode($taken_problems, "', '") . "' )
                            )
                        ORDER BY RAND() LIMIT 1";

                if(!$conn->query($sql))
                {
                       echo $conn->error;
                       exit;
                } //Do error handling in case of invalid tags selected
                else $result = $conn->query($sql);

                $row = $result->fetch_assoc();
                    array_push($_SESSION["problem_id"], $row["problem_id"]);
                    array_push($_SESSION["title"], $row["title"]);
                    array_push($_SESSION["problem_statement"], $row["problem_statement"]);
                    array_push($_SESSION["input_text"], $row["input_text"]);
                    array_push($_SESSION["output_text"], $row["output_text"]);
                    array_push($_SESSION["sample_input"], $row["sample_input"]);
                    array_push($_SESSION["sample_output"], $row["sample_output"]);
                    array_push($_SESSION["tag"], $_POST["tag".($i+1)]);
                    array_push($_SESSION["difficulty"], $_POST["difficulty".($i+1)]);
                    array_push($_SESSION["score"], 0);                     
                    array_push($_SESSION["result"], "");                  
                    array_push($_SESSION["downloaded"], 0);               
                    array_push($_SESSION["count_start"], 0);
                    array_push($taken_problems, $row["problem_id"]);

                if($result->num_rows == 0)
                {
                    $_SESSION["title"][$i] = "Sorry, We are short of problems :(";
                }
            }
        

            $sql = "INSERT INTO contest(username, length) VALUES ('".$_SESSION["username"]."', ".$_POST["duration"].")";
			$result = $conn->query($sql); 
            $sql = "SELECT contest_id FROM contest WHERE contest_id = LAST_INSERT_ID()";
			$result = $conn->query($sql); 
			$row = $result->fetch_assoc();
            $_SESSION["contest_id"] = $row["contest_id"];
            //echo $_SESSION["contest_id"];



	header("Location: contest.php");
	exit();
?>