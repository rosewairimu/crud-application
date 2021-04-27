<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !==true) {
	header("location:login.php");
	exit;
}
require_once "server.php";
$password_1 = $confirm_password = "";
$password_2 = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if (empty(trim($_POST["new_password"]))) {
		$password_2= "please enter new password";
	}elseif (strlen(trim($_POST["new_password"]))< 6) {
		$password_2="password must atleast have 6 characters";
	}else{
		$password_1= trim($_POST['new_password']);
	}
	if (empty(trim($_POST["confirm_password"]))) {
		$confirm_password_err="please confirm password";
	}else{
		$confirm_password = trim($_POST["confirm_password"]);
		if (empty($password_2) && ($password_1 != $confirm_password)) {
			$confirm_password_err= "password did not match";
		}
	}
	if (empty($password_2) && empty($confirm_password_err)) {
		$sql = "UPDATE users SET password = ? WHERE id =?";

		if ($stmt = mysqli_prepare($link, $sql)) {
			mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

			$param_password= password_hash($password_1, PASSWORD_DEFAULT);
			$param_id=$_SESSION["id"];

			if (mysqli_stmt_execute($stmt)) {
			session_destroy();
			header("location: login.php");
			exit();
				
			}else{
				echo "ops! try again later";
			}
			mysqli_stmt_close($stmt);
		}

	}
	mysql_close($link);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["Php_self"]);?>" method="post" >
		<h1>Please enter your info</h1>
 	<p>
 		<label>password:</label><input type="text" name="user">
 		<label>confirm password:</label><input type="password" name="pass">
 		<br/>
 		<br/>
 	</p>
 	<input type="submit" name="submit_btn" value="submit"/>
 	<a href="index.php">cancel</a>
 	
</body>
</html>