<html>
<head>
	<title>Add Ucourse</title>
</head>

<body>
	<a href="dashboard.php">Go to Home</a>
	<br/><br/>

	<form action="add.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr>
				<td>Course Name</td>
				<td><input type="text" name="course_name"></td>
			</tr>
			<tr>
				<td>Course Code</td>
				<td><input type="text" name="course_code"></td>
			</tr>
			
			<tr>
				<td></td>
				<td><input type="submit" name="Submit" value="Add"></td>
			</tr>
		</table>
	</form>

	<?php

	// Check If form submitted, insert form data into users table.
	if(isset($_POST['Submit'])) {
		$course_name = $_POST['course_name'];
		$course_code = $_POST['course_code'];
		

		// include database connection file
		include_once("server.php");

		// Insert user data into table
		$result = mysqli_query($db, "INSERT INTO users(course_name,course_code) VALUES('$course_name','$course_code')");

		// Show message when user added
		echo "course added successfully. <a href='dashboard.php'>View courses</a>";
	}
	?>
</body>
</html>