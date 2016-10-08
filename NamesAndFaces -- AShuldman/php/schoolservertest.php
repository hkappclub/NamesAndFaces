<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);

	$querystr = "CREATE TABLE `list_of_everyone` (" . 
  		"`id` int(11) NOT NULL," .
  		"`first_name` VARCHAR(40) NOT NULL," .
  		"`last_name` VARCHAR(40) NOT NULL," .
  		"`class` VARCHAR(8) NOT NULL," .
		"`address` VARCHAR(100) DEFAULT NULL," . 
  		"`title` VARCHAR(100) DEFAULT NULL," .
  		"`image_url` VARCHAR(150) NOT NULL," .
		"PRIMARY KEY (id)" .
		") ENGINE = InnoDB DEFAULT CHARSET = latin1;";
	/*
	$querystr = "CREATE TABLE `list_of_everyone` (" . 
  		"`id` int(11) NOT NULL," .
  		"`first_name` varchar(40) NOT NULL," .
  		"`last_name` varchar(40) NOT NULL," .
  		"`class` varchar(8) NOT NULL," .
  		"`address` varchar(100) NOT NULL," .
  		"`image_url` varchar(150) NOT NULL" .
		") ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	

	*/
	echo "querystr = " . $querystr . "<p>";
	
	$query = $conn->query($querystr);
	echo "query = " . $query . "<p>"; 


?>
</body>
</html>