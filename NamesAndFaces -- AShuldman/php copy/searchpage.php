<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>

<style>
	.browsetable{
		
	}
	
	table{
	   border-collapse:collapse;
	   padding:10;
	}
	
	table td{
		width:25%;
		display:table-cell;
		vertical-align:top;
		height:70px;
	}
	table td div{
		height:120%;
	}
</style>
</head>

<body>
<?php

require_once("logintwo.php");
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	//select database
	mysql_select_db("namesandfaces");
	
	if(!empty($_GET['firstname']))
	{
		$firstname = $_GET['firstname'];
	}
	else if (!empty($_GET['lastname']))
	{
		$lastname = $_GET['lastname'];
	}
	else
	{
		$firstname = "";
		$lastname = "";	
	}
	
	
	//grab name info from url
	
	if ($firstname != "")
	{
		$querystr = "SELECT id, first_name, last_name, class, image_url FROM namesandfaces . list_of_everyone WHERE first_name LIKE '%$firstname%' ORDER BY last_name";
	}
	else if($lastname != "")
	{
		$querystr = "SELECT id, first_name, last_name, class, image_url FROM namesandfaces . list_of_everyone WHERE last_name LIKE '%$lastname%' ORDER BY last_name";
	}
	else if($lastname == "" || $lastname == "")
	{
		$querystr = "SELECT id, first_name, last_name, class, image_url FROM namesandfaces . list_of_everyone ORDER BY last_name";
	}

	
	
	//create table object to be echoed out at the end
	$dynamic_table = '<div class = "browsetable"><table border = "0" cell padding = "10" >';
	$counter = 0;
	
	//query
	$query = mysqli_query($conn, $querystr);
	
	//populate the table using query info
	while($row = mysqli_fetch_array($query, MYSQL_ASSOC))
	{
		$fullname = $row["first_name"] . " " . $row["last_name"];
		$headshot = $row["image_url"];
		$class = $row["class"];
		$id = $row["id"];
		
		if($counter % 3 == 0)
		{
			$dynamic_table .='<tr><td align = "center"><div>' . generate_url($id) . showimage($headshot) .'<br>';
			$dynamic_table .= '<font face = "Arial" size = "10">' . $fullname . '<br>' . $class . '</font></a></div></td>';
		}
		else
		{
			$dynamic_table .= '<td align = "center"><div>' . generate_url($id) . showimage($headshot) .'<br>';
			$dynamic_table .= '<font face = "Arial" size = "10">' . $fullname . '<br>' . $class . '</font></a></div></td>';
		}
		$counter++;
	}
	
	//end and echo out table
	$dynamic_table .= '</tr></table></div>';
	echo $dynamic_table;
	
	
	//creates image inside the cell
	function showimage($imageurl)
	{
		return <<<END
		<iframe border="0" frameborder="0"
			<img src = "http://$imageurl" width = "250" height = "300"/>
		</iframe>
END;
	}
	
	//generates the hyperlink to single view
	function generate_url($id)
	{
		return "<a href = \"http://namesandfaces.hotchkiss.org/dbsingle.php?id=" . $id . "\"/>";	
	}




?>
</body>
</html>