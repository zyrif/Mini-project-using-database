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
		$query = "SELECT type FROM user WHERE id='".$id."'";
		$result = mysqli_query($con, $query);
		
		if($result){
			$row = mysqli_fetch_array($result);
			
			if($row['type'] == "Admin"){
				
			}
			
			else if($row['type'] == "User"){
				header("location: userhomepage.php");
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
	<title> User List </title>
</head>

<body>
	<table border="1" cellspacing="0">
		<tr> <td  colspan="4">  <center> Users </center> </td> </tr>
		<tr> <td> <p> ID </p> </td> <td> <p> Name </p> </td> <td> <p> Email </p> </td> <td> <p> User Type </p> </td> </tr>
		
<?php	

	if($con) {
		$query = "SELECT id, name, email, type FROM user";
		$result = mysqli_query($con, $query);
		while($row = mysqli_fetch_assoc($result)){

			echo "<tr> <td> <p> $row[id] </p> </td> <td> <p> $row[name] </p> </td> <td> <p> $row[email] </p> </td> <td> <p> $row[type] </p> </td> </tr>";
		
		}	
	}
?>
		<tr> <td  colspan="4"> <a href="./adminhomepage.php"> Go Home </a> </td> </tr>
	
	</table>