yo
<?php session_start(); 
	require "db.php";?>
xyz
<!DOCTYPE html>
<html>
<body>
<?php
	$err = "";
	$sql = "SELECT * FROM user WHERE username = '".$_POST["username"]."'";
	$result = $conn->query($sql);
	echo "kachra";
	if($result->num_rows > 0)
	{
		$_SESSION["register_err"] = "Username already taken :(";
		//header("Location: ./index.php");
		exit;
	}


		$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
		$sql = "INSERT INTO user (username, name, email, password)
		VALUES ('".$_POST["username"]."', '".$_POST["name"]."', '".$_POST["email"]."', '".$hash."')";
		if($conn->query($sql) == TRUE)
		{
			$_SESSION["username"] = $row["username"];
			//header('Location: ./home.php');
		}
		else
		{
			echo "Registration failed: ".$conn->error."<br>";
			
		}

?>
</body>
</html>
