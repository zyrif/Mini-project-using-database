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
	
	$query = "SELECT password, type FROM user WHERE id='$id'";
	$con = mysqli_connect("localhost", "root", "", "user_db");
	$result = mysqli_query($con, $query);
	
	$row = mysqli_fetch_array($result);
	if($pass == $row['password']){
		if($row['type'] == "admin"){
			$_SESSION['id'] = $id;
			header("location: adminhomepage.php");
		}
		else if($row['type'] == "user"){
			$_SESSION['id'] = $id;
			header("location: userhomepage.php");
		}
	}
	
	else{
		echo "Invalid username/password";
	}		
}
