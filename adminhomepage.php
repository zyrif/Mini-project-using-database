<?php 

	session_start();

	if($_SESSION['id'] != ""){
		$id = $_SESSION['id'];
	}
	else {
		header("location: login.php");
	}
	
	$con = mysqli_connect("localhost", "root", "", "user_db");
	if($con) {
		$query = "SELECT name,type FROM user WHERE id='".$id."'";
		$result = mysqli_query($con, $query);
		
		if($result){
			$row = mysqli_fetch_array($result);
			if($row['type'] == "Admin"){
				$name = $row['name'];
			}
			
			else if($row['type'] == "User"){
				header("location: userhomepage.php");
			}

			else {
				header("location: login.php");
			}
		}
		
		else{
			header("location: login.php");
		}
	}
	else {
		header("location: login.php");
	}
?>


<html>
	<head>
		<title> Admin's Homepage </title>
	</head>
	
	<body>
		<fieldset>
			<center> <h1> <b> Welcome, <?php echo $name?>! </b> </h1> </center>
			<br/>
			<center> <a href="./profile.php"> Profile </a> </center>
			<center> <a href="./passchange.php"> Change Password </a> </center>
			<center> <a href="./userview.php"> View Users </a> </center>
			<center> <a href="./logout.php"> Logout </a> </center>
		</fieldset>
	</body>
</html>