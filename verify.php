 <?php
$myfile = fopen("input/one", "r") or die("Unable to open file!");
echo fread($myfile,filesize("input/one"));
fclose($myfile);
?> 