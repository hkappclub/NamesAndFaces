<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Browse</title>
</head>

<body>
<?php
	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);

	$querystr = "CREATE TABLE `list_of_everyone` (" . 
  		"`id` int(11) NOT NULL," .
  		"`first_name` varchar(40) NOT NULL," .
  		"`last_name` varchar(40) NOT NULL," .
  		"`class` varchar(8) NOT NULL," .
  		"`address` varchar(100) NOT NULL," .
  		"`image_url` varchar(150) NOT NULL" .
		") ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	
	echo "querystr = " . $querystr . "<p>";
	
	$query = $conn->query($querystr);
	echo "query = " . $query . "<p>"; 

//		$query = mysql_query("SELECT first_name, last_name, image_url, id FROM sample_data . list_of_everyone ORDER BY last_name");


/*	
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
		$query = mysql_query("SELECT first_name, last_name, image_url, id FROM sample_data . list_of_everyone ORDER BY last_name");
	}
	else
	{
		$query = mysql_query("SELECT first_name, last_name, image_url, id FROM sample_data . list_of_everyone WHERE class = '$class' ORDER BY last_name");
	}
	
	
	$dynamic_table = '<table border = "0" cellpadding="10"  >';
	$counter = 0;
	
	function showimage($imageurl)
	{
		return <<<END
		<iframe border="0" frameborder="0"
			<img src = "http://$imageurl" width = "375" height = "400"/>
		</iframe>
END;
	}
	
	function generate_url($id)
	{
		return "<a href = \"http://localhost/Single.php?id=" . $id . "\"/>";
	}
	
	if($query === FALSE)
	{
	die(mysql_error());
	}
	
		while($row = mysql_fetch_array($query))
		{
			$fullname = $row["first_name"] . " " . $row["last_name"];
			$headshot = $row["image_url"];
			$id = $row["id"];
		
			if($counter % 3 == 0)
			{
				$dynamic_table .= '<tr><td align = "center">'. generate_url($id) . showimage($headshot) .'<br>';
				$dynamic_table .=  '<font face = "Arial" size = "6">' . $fullname . '</font></a></td>';
			}
			else
			{
				$dynamic_table .= '<td align = "center">' . generate_url($id) . showimage($headshot) .'<br>';
				$dynamic_table .= '<font face = "Arial" size = "6">' . $fullname . '</font></a></td>';
			}
			$counter++;
		}
	
	$dynamic_table .= '</tr></table>';
	echo $dynamic_table;
	
*/	
?>
</body>
</html>
