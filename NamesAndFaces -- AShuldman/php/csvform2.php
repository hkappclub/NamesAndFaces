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
	mysql_select_db("namesandfaces", $conn);
	
	echo "Running!<br>";
	echo "File = " . $_FILES["file"]["tmp_name"] . "<br>";
	
	$querystr = "";
	
	if(isset($_POST["submit"]))
	{
		$handle = fopen($_FILES["file"]["tmp_name"], "r");
		if ($handle) {
			while (($line = fgets($handle)) !== false) {
				echo "line = " . $line . "<br>";

				$values = explode(",",$line);
				
				$querystr = <<<_END
				INSERT INTO list_of_everyone2
				(first_name, last_name, class, address, title, image_url)
				VALUES
				('{$values[0]}', '{$values[1]}', '{$values[2]}', '{$values[3]}', '{$values[4]}', '{$values[5]}')
_END;
			
				echo "query = " . $querystr . "<br>";
		
				$sql = $conn->query($querystr);
				if($sql)
				{
					echo "data uploaded successfully<br>";
				}
				else
				{
					echo "fail upload!<br>";
				}
			}
		
			fclose($handle);
		} else {
			echo "fail read<br>";
		} 		
	
	}
	else
	{
		echo "fail submit!<br>";
	}
?>

</body>
</html>

