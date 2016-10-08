<?php
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	mysql_select_db("namesandfaces", $conn);
	
	if(isset($_POST['Submit']))
	{
		echo "inside IF statement<br>";
		
		$file = $_FILES['file']['tmp_name'];
		
		$handle = fopen($file, "r"); //open in read mode
		
		while(($fileop = fgetcsv($handle, 1000, ",")) !== false)
		{
			//$id 		 = $fileop[0];
			$first_name	 = $fileop[1];
			$last_name	 = $fileop[2];
			$class		 = $fileop[3];
			$address	 = $fileop[4];
			$title		 = $fileop[5];
			$image_url 	 = $fileop[6];
			
			$querystr = "INSERT INTO list_of_everyone (first_name, last_name, class, address, title, image_url) VALUES ('$first_name', '$last_name', '$class', '$address', '$title', '$image_url')";
			echo "query = " . $querystr;
			$sql = $conn->query($querystr);
			
			echo "first name: " . $first_name . " last name: " . $last_name . " class: " . $class . " address: " . $address . " title: " . $title . " image url: " . $image_url . "<br>";
			
			echo "query = " . $sql . "<br>";
		}
		if($sql)
		{
			echo "data uploaded successfully";
		}
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Upload CSV File</title>
<?php
	$submit = $_POST['Sumbit'];
?>
</head>

<body>
	<form method = "post" action = "uploadcsvfile.php" enctype="multipart/form-data">
   	  <input type = "file" name = "file"/>
        <br />
      <input type = "Submit" name = "Submit" value = "Submit" />
    </form>
    
</body>
</html>