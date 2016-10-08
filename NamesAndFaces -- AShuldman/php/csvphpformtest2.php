<?php

	require_once 'login.php';
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	mysql_select_db("namesandfaces", $conn);
	
	//if(isset($_POST['submit']))
	{
		echo "inside if loop";
		
		if(document.getElementById('student').checked)
		{
 			/*
			first_name = student_first+(student_preferred)
			last_name = student_last
			address = student_state+student_country
			class = graduation_year
			*/
			echo "student";
			
		}
		else if(document.getElementById('facstaff').checked)
		{
  			/*
			first_name = firstname
			last_name = lastname+suffix
			title = department1title
			*/
			echo "facstaff";
		}
		
		$file = $_POST['file']['tmp_name'];
	
		if (($handle = fopen("$file")) !== FALSE)
		{
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
			{
			
				$querystr = "INSERT INTO list_of_everyone (first_name, last_name, class, address, title, image_url) VALUES ('$first_name', '$last_name', '$class', '$address', '$title', '$image_url')";
			
				$query = mysql_query($querystr);
				if($query)
				{
					echo "row inserted";
				}
				else
				{
					echo die(mysql_error());
				}
			}
		}
	}
	else
	{
		echo "else";
	}
?>