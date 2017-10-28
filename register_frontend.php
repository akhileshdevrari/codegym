<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>codegym</title>
</head>
<body>
	<h1>It's CODEGYM bitch !</h1>

	<?php
		if(isset($_SESSION["register_err"]))
			echo $_SESSION["register_err"]."<br><br>";
	?>

	<form action="register_backend.php" method="post">
	<fieldset>
	<legend>Register here</legend>
		Username: <input type="text" name="username" required><br>
		Name: <input type="text" name="name" required><br>
		E-mail: <input type="text" name="email"><br>
		Password: <input type="password" name="password1" required><br>
		Confirm password: <input type="password" name="password2" required><br>
		<button type="submit" value="Submit">Submit</button>
		<button type="reset" value="Reset">Reset</button>
	</fieldset>
	</form>

	<?php $_SESSION["loginerr"] = ""; ?>
	<p>Or <a href="./index.php">Login here</a></p>

</body>
</html>