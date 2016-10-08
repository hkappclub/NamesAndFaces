<html>
<head>
<title>Database Altering</title>

<script>
	function selectknowninfo()
	{
		var correctedInfo = document.getElementById("newvalue");
		
		if (document.getElementById('firstnamefield').checked)
		{
			var knownvalue1 = document.getElementById("firstnametext").value;
		}
		if(document.getElementById('lastnamefield').checked)
		{
			var knownvalue2 = document.getElementById("lastnametext").value;
		}
		if(document.getElementById('classfield').checked.checked)
		{
			var knownvalue3 = document.getElementById("classtext").value;
		}
		window.alert("askjfh");
	}
</script>

</head>
<body>
<?php

	echo "INSTRUCTIONS:<br>
	Enter the information that needs to be changed in the first text box.  Then, enter the known information for first name, last name, and class and check the box next to each field.  If you are currently correcting information for either first name, last name, or class, enter the current value for that field.  For example if you're changing someone's first name from Jon to John, enter Jon here.  If the incorrect information is not known, leave the text box blank and the checkbox UNCHECKED.<br><br>For first name changes: Format the first name so that the actual first name is first and the preferred first name is in paranthesis.  For example: Jonathon (John)<br>For last name changes: Include suffix if there is one.  For example: Smith III<br>For class changes: Use the full year (ex. 2016) or FACSTAFF.....write the rest of this later<br>";
	
	
	
	require_once('logintwo.php');
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	mysql_select_db("namesandfaces", $conn);
	
	$fieldselected = $_POST['field'];
	echo $fieldselected;
	
	if($fieldselected == 'firstname')
	{
		$fieldtochange = "first_name";
	}
	else if($fieldselected == 'lastname')
	{
		$fieldtochange = "last_name";
	}
	else if($fieldselected == 'class')
	{
		$fieldtochange = "class";
	}
	else if($fieldselected == 'address')
	{
		$fieldtochange = "address";
	}
	else if($fieldselected == 'title')
	{
		$fieldtochange = "title";
	}
	else if($fieldselected == 'imageurl')
	{
		$fieldtochange = "image_url";
	}
	
	echo <<<END
	<h3>Change $fieldtochange to:
	
	<input type = "text" id="newvalue"></h3>
	
	<h3>Known information about person:</h3>
		
			<input type=	"checkbox" 	id="firstnamefield" 	value="firstname">First Name
			<input type =	"text" 		name="firstnametext">	<br>
			<input type=	"checkbox" 	id="lastnamefield" 	value="lastname">Last Name
			<input type =	"text" 		name="lastnametext">	<br>
			<input type=	"checkbox" 	id="classfield" 		value="class">Class
			<input type =	"text" 		name="classtext">		<br><br><br>
			<input type=	"submit" 	name="finalizeselection" value="Finalize All Information" onclick="selectknowninfo()"><br><br><br>
		
END;

	

	$querystr = "UPDATE list_of_everyone SET $fieldtochange=______ WHERE $knownfield=$knownvalue";
	echo $querystr;
	
	

//UPDATE list_of_everyone SET image_url='namesandfaces.hotchkiss.org/sampledataset/16_Kalaydjian_Edward.jpg' WHERE id=18;
//<form method = "post" action="editinfoformtest.php" name="editinfosubmit">
?>
</body>
</html>