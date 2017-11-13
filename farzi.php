<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Resume Upload</title>
</head>
<body style="text-align:center">
<?php
	if (!array_key_exists('Submitted',$_POST)) {
?>
<h2>Resume Upload Form</h2>
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="Submitted" value="true">
<table border="1">
<tr>
	<td>First Name</td>
	<td><input type="text" name="FirstName" size="20"></td>
</tr>
<tr>
	<td>Last Name</td>
	<td><input type="text" name="LastName" size="20"></td>
</tr>
<tr>
	<td>Resume</td>
	<td><input type="file" name="Resume"></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" value="Upload"></td>
</tr>
</table>
</form>
<?php
} else {
	//process the  form
	$resumeFile = $_FILES['Resume']['tmp_name'];
	$fileSize = $_FILES['Resume']['size'];
	$fileType = $_FILES['Resume']['type'];
	$fileError = $_FILES['Resume']['error'];

	$resumeName=$_POST['FirstName'] . '_' .
			$_POST['LastName'] . '_Resume.txt';
	if ($fileError)
	{
		echo "We could not upload the file:<br>$fileError";
		endPage();
	}
	elseif ($fileType != 'text/plain')
	{
		echo "You have attempted to upload a file of type: $fileType.
				<br>Only text files allowed.";
		endPage();
	}

	$fileSavePath = 'Resumes/' . $resumeName;	
	if (is_uploaded_file($resumeFile))
	{
		if (!move_uploaded_file($resumeFile,$fileSavePath))
		{
			echo 'Could not save file.';
			endPage();
		}
	}
	else
	{
		//This case happens if somehow the file
		//we are working with was already on the server.
		//It's to stop hackers.
		echo 'Hey, what is going on here?
					Are you being bad?';
		endPage();
	}
	$resume=makeFileSafe($fileSavePath);
?>
	<h2>Thanks!</h2>
	<b>We got your resume.</b><hr>
	<form>
	<textarea cols="60" rows="20"><?php echo $resume ?></textarea>
	</form>
	</p>
<?php
}

function endPage()
{
	echo '</body></html>';
	exit;
}

function makeFileSafe($filePath)
{
	$fP = @fopen($filePath,'r+');
	if (!$fP)
	{
		return "Could not read file";
	}
	$contents = fread($fP,filesize($filePath));
	$contents = strip_tags($contents);
	rewind($fP);
	fwrite($fP,$contents);
	fclose($fP);
	return $contents;
}
?>
</body>
</html>