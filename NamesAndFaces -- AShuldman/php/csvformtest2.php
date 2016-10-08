<html>
<head>
<title>Untitled Document</title>
</head>

<body>
	<form method="post" action="csvform2.php" enctype="multipart/form-data">
		<input type="radio" name="studentorfacstaff" value="student"> Import Student<br>
  		<input type="radio" name="studentorfacstaff" value="facstaff"> Import Faculty/Staff<br>
        <input type="file" name="file">
    	<input type="submit" value="Upload file" name="submit">
	</form>
</body>
</html>
