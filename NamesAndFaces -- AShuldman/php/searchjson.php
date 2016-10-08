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

	$querystr = "SELECT id, first_name, last_name FROM namesandfaces . list_of_everyone ORDER BY last_name";
	
	if($query = mysqli_query($conn, $querystr))
	{
		$resultArray = array();
		$tempArray = array();
		
		while($row = mysqli_fetch_array($query, MYSQL_ASSOC))
		{
			$tempArray = $row;
			array_push($resultArray, $tempArray);	
		}
		
		echo json_encode($resultArray);
	}
	
	mysqli_close($conn);

?>
</body>
</html>