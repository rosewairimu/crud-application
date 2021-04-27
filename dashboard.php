<?php
// Create database connection using config file
include_once("server.php");

// Fetch all users data from database
$result = mysqli_query($db, "SELECT * FROM users ORDER BY id DESC");
?>

<html>
<head>
    <title>Homepage</title>
</head>

<body>
<a href="add.php">Add New Course</a><br/><br/>

    <table width='80%' border=1>

    <tr>
        <th>Course Name</th> <th>Course Code</th> 
    </tr>
    <?php
    while($user = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$user['course_name']."</td>";
        echo "<td>".$user['course_code']."</td>";
        
        echo "<td><a href='edit.php?id=$user[id]'>Edit</a> | <a href='delete.php?id=$user[id]'>Delete</a></td></tr>";
    }
    ?>
    </table>
</body>
</html>