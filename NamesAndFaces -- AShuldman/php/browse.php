<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Browse</title>
</head>

<body>
<?php
		//require_once 'logintwo.php';
		//$conn = new mysqli($hn, $un, $pw, $db);
		$conn = new mysqli("localhost", "namesandfaces", "W3bC0urse!", "namesandfaces");
		if ($conn->connect_error) die($conn->connect_error);
		mysql_select_db("namesandfaces");
		
		//echo "stat = " . $conn->stat() . "<br>";
		
		echo "BROWSE<br>";
		
		if(empty($_GET['class'] ))
		{
			$class = "";
		}
		else
		{
			$class = $_GET['class'];
		}
	
		if ($class == "")
		{
			$querystr = "SELECT first_name, last_name, class, image_url, id FROM namesandfaces . list_of_everyone ORDER BY last_name";
		}
		else
		{
			$querystr = "SELECT first_name, last_name, class, image_url, id FROM namesandfaces . list_of_everyone WHERE class = '$class' ORDER BY last_name";
		}
		
		echo "query: " . $querystr;
		//$query = $conn->query($querystr) or die("Error!");
		$query = mysqli_query($conn, $querystr); //or die("Error!");
		
		echo "query result:" . $query . "<br>";
		
		$dynamic_table = '<table border = "0" cellpadding="10"  >';
		$counter = 0;
	
		echo "result: " . mysql_fetch_array($query);
		
		while($row = mysql_fetch_array($query))
		{
			$fullname = $row["first_name"] . " " . $row["last_name"];
			$headshot = $row["image_url"];
			$id = $row["id"];
			$class = $row["class"];
		
			if($counter % 3 == 0)
			{
				$dynamic_table .= '<tr><td align = "center">'. generate_url($id) . showimage($headshot) .'<br>';
				$dynamic_table .=  '<font face = "Arial" size = "6">' . $fullname . '<br>' . $class . '</font></a></td>';
			}
			else
			{
				$dynamic_table .= '<td align = "center">' . generate_url($id) . showimage($headshot) .'<br>';
				$dynamic_table .= '<font face = "Arial" size = "6">' . $fullname . '<br>' . $class .'</font></a></td>';
			}
			$counter++;
		}
	
	$dynamic_table .= '</tr></table>';
	echo $dynamic_table;
	
	
		function showimage($imageurl)
		{
			return <<<END
			<iframe border="0" frameborder="0"
				<img src = "http://$imageurl" width = "250" height = "300"/>
			</iframe>
END;
		}
		
		function generate_url($id)
		{
			return "<a href = \"http://namesandfaces.hotchkiss.org/Single.php?id=" . $id . "\"/>";
		}
		
	
?>
</body>
</html>