<?php
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	mysql_select_db("namesandfaces", $conn);
	
	if(isset($_POST['submit']))
	{
		$file = $_POST['file'];
	
		$querystr = <<<_END
		LOAD DATA INFILE '$file'
		INTO TABLE 'list_of_everyone'
		FIELDS TERMINATED BY ','
		LINES TERMINATED BY '\n'
		('first_name', 'last_name', 'class', 'address', 'title', 'image_url');
_END;
	
	echo "in if loop";
	}
	
	echo "query = " . $querystr;
	$sql = $conn->query($querystr);
	if($sql)
	{
		echo "data uploaded successfully";
	}
	
echo <<<_END
<html>
	<head>
		<title>CSV UPLOAD FORM</title>
	</head>
	<body>
	<form method="post" action="csvform.php" enctype="multipart/form-data">
		<input type="file" name="file">
		<input type="submit">
	</form>
	</body>
</html>
_END;
?>
