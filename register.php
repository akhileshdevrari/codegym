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
			//header('Location: home.php');
			//exit;
		}
		else
		{
			echo "Registration failed: ".$conn->error."<br>";
			
		}

		if(file_exists($_FILES['photo']['tmp_name']) && is_uploaded_file($_FILES['photo']['tmp_name']))
		{


			echo "Upload: " . $_FILES["photo"]["name"] . "<br>";
			echo "Type: " . $_FILES["photo"]["type"] . "<br>";
			echo "Size: " . ($_FILES["photo"]["size"] / 1024) . " kB<br>";
			echo "Stored in: " . $_FILES["photo"]["tmp_name"]."<br>";

			// // store file content as a string in $str
			// $str = file_get_contents($_FILES["photo"]["tmp_name"]);
			// echo($str."<br><br>");

        	$target_dir = "images/";
			$target_file = $target_dir . basename($_FILES["photo"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			// Check file size
			if ($_FILES["photo"]["size"] > 5000000) {
			    $_SESSION["register_err"] = "Profile too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    $_SESSION["register_err"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed as profile photo";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "nhi ho pa raha hum se<br>";
			    header("Location: index.php");
			// if everything is ok, try to upload file
			} else {echo "jai hind<br>";
			    if (move_uploaded_file($_FILES["photo"]["tmp_name"], "images/".$_SESSION["username"].",jpeg.com")) 
			    {
			    	$sql = "UPDATE user SET image_path = 'images/".$_SESSION["username"].",jpeg.com' WHERE username = '".$_SESSION["username"]."'";
			    	if($conn->query($sql))
			    	{
						header('Location: home.php');
			        	exit;
			        }
			        else echo "mysql me nhi ja ra";
			    } 
			    else {
			    	echo "reeioooooooo";
			        $_SESSION["register_err"] = "Error while uploading profile photo";
			    }
			}
		}
		else
			header('Location: home.php');
?>
</body>
</html>
