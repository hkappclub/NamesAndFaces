<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	require_once("logintwo.php");
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	mysql_select_db("namesandfaces");
	
	if ($_FILES["csvfile"]["error"] > 0)
  	{
  		echo "Error: " . $_FILES["csvfile"]["error"] . "<br />";
  	}
	else
  	{
  		echo "Upload: " . $_FILES["csvfile"]["name"] . "<br />";
  		echo "Type: " . $_FILES["csvfile"]["type"] . "<br />";
 		echo "Stored in: " . $_FILES["csvfile"]["tmp_name"] . "<br>";
  	}
	
	$file = $_FILES["csvfile"]["tmp_name"];
	
	if(!empty($_POST['studentorfacstaff']))
	{
		if ($_POST['studentorfacstaff']=="student")
		{
			$student = true;
			$deletequerystr = "DELETE FROM list_of_everyone WHERE NOT class='FACSTAFF'";
		}
		else if($_POST['studentorfacstaff']=="facstaff")
		{
			$student = false;
			$deletequerystr = "DELETE FROM list_of_everyone WHERE class='FACSTAFF'";
		}
	}
	
	
	if(!mysqli_query($conn, $deletequerystr))
    {
        die('Error : ' . mysqli_error() . "<br><br>Make sure an import method was selected on the previous page");
    }
	
	
	$fp = fopen($file, "r") or die("Error here");

	while(($row = fgetcsv($fp, "500", ",")) != FALSE)
	{
		$querystr = "INSERT INTO list_of_everyone (first_name, last_name, class, address, title, image_url) VALUES('" . implode("','", $row) . "')";
		echo $querystr . "<br><br>";
		
		if(!mysqli_query($conn, $querystr))
    	{
        	die('Error : ' . mysqli_error());
    	}
	}
	
	fclose($fp);
	mysqli_close($conn);
	echo "done<br>";

?>
</body>
</html>