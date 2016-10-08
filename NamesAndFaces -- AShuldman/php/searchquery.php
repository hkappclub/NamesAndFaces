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
	
	$querystr = "SELECT id, first_name, last_name, FROM namesandfaces . list_of_everyone ORDER BY last_name";
	
	echo $querystr . "<br>";
	
	if($query = mysqli_query($conn, $querystr))
	{
		echo "if<br>";
		$resultArray = array();
		$tempArray = array();
		
		while($row = $query->fetch_object())
		{
			$tempArray = $row;
			array_push($resultArray, $tempArray);
			echo "while<br>";
		}
	}
	else
	{
		echo "else<br>";
	}
	echo json_encode($resultArray);
	echo "done<br>";
	mysqli_close($con);
	
/*
f ($result = mysqli_query($con, $sql))
{
	// If so, then create a results array and a temporary one
	// to hold the data
	$resultArray = array();
	$tempArray = array();
 
	// Loop through each row in the result set
	while($row = $result->fetch_object())
	{
		// Add each row into our results array
		$tempArray = $row;
	    array_push($resultArray, $tempArray);
	}
 
	// Finally, encode the array to JSON and output the results
	echo json_encode($resultArray);
}
 
// Close connections
mysqli_close($con);


////////
	
	$fh = fopen("/Users/student/Documents/naf/search.txt", 'r+') or die("File does not exist or you lack permission to open it.<br>");
	
	$querystr = "SELECT id, first_name, last_name, FROM namesandfaces . list_of_everyone ORDER BY last_name";
	
	$query = mysqli_query($conn, $querystr);
	
	while($row = mysqli_fetch_array($query, MYSQL_ASSOC))
	{
		$fullname = $row["first_name"] . " " . $row["last_name"];
		$id = $row["id"];
		
		$ftext = $fullname . "\n" . $id . "\n";
		fwrite($fh, $text) or die("Could not write to file<br>");
	}
	
	fclose($fh);
	echo "File 'search.txt' written successfully.<br>";
	
*/
?>
</body>
</html>