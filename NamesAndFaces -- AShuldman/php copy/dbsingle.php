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

	//get info from database depending on id variable in url
	$id = $_GET['id'];
	$querystr = ("SELECT * FROM namesandfaces . list_of_everyone WHERE id = $id");
	$query = mysqli_query($conn, $querystr);
	$person = mysqli_fetch_array($query, MYSQL_ASSOC);
	
	//grab information
	$fullname = $person["first_name"] . " " . $person["last_name"];
	$class = $person["class"];
	$imageurl = $person["image_url"];
	
	//if a student
	if($class < "FACSTAFF")
	{
		$class = "Class of $class";
		$address = $person["address"];
	}
	//if a fac/staff
	else
	{
		$address = $person["title"];
	}
	
	//create table
	$dynamic_table = <<<END
	<center>
	<table border = "0" cellpadding="100">
	<tr>
		<iframe border="0" frameborder="0"
		<img src = "http://$imageurl" width = "250" height = "300"/>
		</iframe>
	</tr>
	<tr>
		<font face = "Arial" size = "10">
			<br>$fullname<br>$class<br>$address
		</font>
	</tr>
	<table>
	</center>
	
END;

	echo $dynamic_table;
?>
</body>
</html>