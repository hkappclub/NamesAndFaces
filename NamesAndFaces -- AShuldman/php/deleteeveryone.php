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
	
	$querystr = "TRUNCATE TABLE list_of_everyone";
	
	if(!mysqli_query($conn, $querystr))
    {
        die('Error : ' . mysqli_error());
    }
	else
	{
		echo "Everyone deleted";
	}
?>
</body>
</html>