<?php

	require_once('logintwo.php');
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	
	mysql_select_db("namesandfaces", $conn);
	
	if(isset($_POST['submit']))
	{
		echo "inside if loop<br>";
		$classSelection = $_POST['studentorfacstaff'];
		
		
		
		$file = $_POST['file']['tmp_name'];
	
		if (($handle = fopen("$file")) !== FALSE)
		{
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
			{
			
				if($classSelection == 'student')
				{
 				/*
				first_name = student_first+(student_preferred)
				last_name = student_last
				address = student_state+student_country
				class = graduation_year
				*/
				$quertstr = "INSERT INTO list_of_everyone (first_name, last_name, class, address, title, image_url) VALUES('$first_name', $last_name', '$class', '$address', '','$image_url');";
				
				echo "student<br>";
				
				}
				else if($classSelection == 'facstaff')
				{
				/*
				first_name = firstname
				last_name = lastname+suffix
				title = department1title
				*/
				$querystr = "INSERT INTO list_of_everyone (first_name, last_name, class, address, title, image_url) VALUES('$first_name', '$last_name', '$class', '', '$title', '$image_url');";
				
				echo "facstaff<br>";
				}
				
				//$querystr = "INSERT INTO list_of_everyone (first_name, last_name, class, address, title, image_url) VALUES ('$first_name', '$last_name', '$class', '$address', '$title', '$image_url');";
			
				$query = mysqli_query($conn, $querystr);
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