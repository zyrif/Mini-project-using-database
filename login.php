<html>
<head>
	<title> Log In </title>
</head>

<body>
	<form method="post">
	<fieldset>
		<legend> Log In </legend>
		User Id: 
		<br/>
		<input type="text" name="idfield"/>
		<br/>
		
		Password:
		<br/>
		<input type="password" name="passfield"/>
		<br/>
			
		<input type="checkbox" name="remembercheck"/> Remember Me
		<br/>
		<hr/>	
		
		<input type="submit" name="login"/>
		<a href="./registration.php"> Register </a>
		
	</fieldset>
	</form>

</body>
</html>

<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
	
	session_start();
	
	$id = trim($_REQUEST['idfield']);
	$pass = trim($_REQUEST['passfield']);
	
	$con = mysqli_connect("localhost", "root", "", "user_db");
	if($con) {
		$query = "SELECT password, type FROM user WHERE id='".$id."'";
		$result = mysqli_query($con, $query);
		
		if($result){
			$row = mysqli_fetch_array($result);
			if($pass == $row['password']){
				if($row['type'] == "Admin"){
					$_SESSION['id'] = $id;
					header("location: adminhomepage.php");
				}
				else if($row['type'] == "User"){
					$_SESSION['id'] = $id;
					header("location: userhomepage.php");
				}
			}
			else {
				echo "Error while querying to database.";
			}
		}
		
		else{
			echo "Invalid username/password";
		}
	}
	else {
		echo "Error connecting to database.";
	}
}
