<?php session_start(); 
	require "db.php";?>
<!DOCTYPE html>
<html>
<body>
<?php
	$err = "";
	$sql = "SELECT * FROM user WHERE username = '".$_POST["username"]."'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		$_SESSION["register_err"] = "Username already taken :(";
		//echo "oneee";
		header("Location: index.php");
		exit;
	}


		$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
		$sql = "INSERT INTO user (username, name, email, password)
		VALUES ('".$_POST["username"]."', '".$_POST["name"]."', '".$_POST["email"]."', '".$hash."')";
		if($conn->query($sql) == TRUE)
		{
			//echo "twoo";
			$_SESSION["username"] = $_POST["username"];
			header('Location: home.php');
			exit;
		}
		else
		{
			echo "Registration failed: ".$conn->error."<br>";
			
		}

?>
</body>
</html>
