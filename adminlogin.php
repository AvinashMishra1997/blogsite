<?php

session_start();

include "../includes/config.php";

if(isset($_POST['submit'])){
	$username=$_POST['username'];
	$pwrd=$_POST['pwrd'];
	include "../includes/db.php";
	if(empty($username) || empty($pwrd)){
		echo "Missing LogIn Contents";
	}else{
		$username=strip_tags($username);
		$username=$db->real_escape_string($username);
		$pwrd=strip_tags($pwrd);
		$pwrd=$db->real_escape_string($pwrd);
		$pwrd=md5($pwrd);
		$query=("SELECT user_id, username FROM login WHERE username='$username' AND password='$pwrd'");
		$query=$db->query($query);
		if($query->num_rows === 1){
			while($row = $query->fetch_object()){
				$_SESSION['user_id']=$row->user_id;
				$user_id = $row->user_id;
			}
			
			if($user_id ==1){
			header('Location: adminindex.php');
			exit();
			}else{
			header('Location: ../users/userindex.php');
			exit();
			}
		}else{
			echo 'Error With USERNAME or PASSWORD';
		}
	}
}
?>


<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" href="main.css"/>
		<title>Blog Site Name</title>
	</head>
	<body>
		<section>
			<div id="main_content" >
				<form action="adminlogin.php" method="post">
				<label>Username : </label><input type="text" name="username" value=""/></br></br></br>
				<label>Password : </label><input type="password" name="pwrd" value=""/></br></br></br>
				<input type="submit" name="submit" value="LogIn"/>
				</form>
			</div>
		
		</section>

	</body>

</html>





