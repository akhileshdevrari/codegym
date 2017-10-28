<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>codegym</title>
</head>
<body>

	<h1>It's CODEGYM bitch !</h1>
	<br><br>

	<?php
		if(isset($_SESSION["loginerr"]))
			if($_SESSION["loginerr"] != "")
				echo $_SESSION["loginerr"]."<br><br>";
	?>

	<form method="post" action="./login.php">
		<fieldset>
		<legend>Login here</legend>
			Username: <input type="text" name="username" required><br>
			Password: <input type="password" name="password" required><br>
			<input type="submit" value="Log in"><br>
		</fieldset>
	</form>

	<br><br>

	<p>New User? <a href="./register_frontend.php">Register here</a></p>

</body>
</html>