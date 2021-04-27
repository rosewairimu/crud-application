<?php
// include database connection file
include_once("server.php");

// Check if form is submitted for user update, then redirect to homepage after update
if(isset($_POST['update']))
{
	$id = $_POST['id'];

	$course_name=$_POST['course_name'];
	$course_code=$_POST['course_code'];
	

	// update user data
	$result = mysqli_query($db, "UPDATE users SET course_name='$course_name',course_code='$course_code' WHERE id=$id");

	// Redirect to homepage to display updated user in list
	header("Location: dashboard.php");
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id
$result = mysqli_query($db, "SELECT * FROM users WHERE id=$id");

while($user = mysqli_fetch_array($result))
{
	$course_name = $user['course_name'];
	$course_code = $user['course_code'];
	
}
?>
<html>
<head>
	<title>Edit Course Data</title>
</head>

<body>
	<a href="dashboard.php">Home</a>
	<br/><br/>

	<form name="update_user" method="post" action="edit.php">
		<table border="0">
			<tr>
				<td>Course Name</td>
				<td><input type="text" name="name" value=<?php echo $course_name;?>></td>
			</tr>
			<tr>
				<td>Course code</td>
				<td><input type="text" name="email" value=<?php echo $course_code;?>></td>
			</tr>
			
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>