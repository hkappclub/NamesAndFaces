<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sample Query Program</title>
</head>

<body>
<?php

	$conn = new mysqli("localhost", "namesandfaces", "W3bC0urse!", "namesandfaces");
	if ($conn->connect_error) die($conn->connect_error);
	
	if(!$conn)
	{
	  die('Could not connect<br>');
	}
	else
	{
		echo 'Connected<br>';
	}
	
	mysql_select_db("namesandfaces");
	
	$mysql = 'SELECT * FROM list_of_everyone';
	
	$query = mysqli_query($conn, $mysql);
	if(!$query)
	{
	  die('Query failed<br>');
	}
	else
	{
		echo 'Query successful<br>';
	}

	
	while($row = mysqli_fetch_array($query, MYSQL_ASSOC))
	{
		echo "First Name :{$row['first_name']}  <br> ".
			 "Last Name: {$row['last_name']} <br> ".
			 "Class: {$row['class']} <br> ".
			 "--------------------------------<br>";
	} 
	
	echo "Fetched data successfully<br>";

?>
</body>
</html>