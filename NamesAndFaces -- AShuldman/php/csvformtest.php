<html>
<head>
<title>Database Updating/Altering</title>
</head>

<body>
	<h1>Upload CSV File:</h1>
	<form method="post" action="csvimport.php" name = "uploadfile" enctype="multipart/form-data">
		<input type="radio" name="studentorfacstaff" value="student"> Upload Student File<br>
  		<input type="radio" name="studentorfacstaff" value="facstaff"> Upload Faculty/Staff File<br>
        <input type="file" name="csvfile" ><br>
		<input type="submit" name="submit">
    </form>
    <h1>Delete Everyone From Database:</h1>
    <form method="post" action="deleteeveryone.php" name="deleteeveryone">
    	<input type="submit" name="deletesubmit" value="Delete Everyone">
    </form>
</body>
</html>
