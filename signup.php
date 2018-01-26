<?php

session_start();

include "../includes/config.php";

if(isset($_POST['submit'])){
	$username=$_POST['username'];
	$email = $_POST['emailid'];
	$pwrd=$_POST['pwrd'];
	include "../includes/db.php";
	if(empty($username) || empty($pwrd) || empty($email)){
		echo "Missing Contents";
	}else{
		$username=strip_tags($username);
		$username=$db->real_escape_string($username);
		$email=strip_tags($email);
		$email=$db->real_escape_string($email);
		$pwrd=strip_tags($pwrd);
		$pwrd=$db->real_escape_string($pwrd);
		$pwrd=md5($pwrd);
		if(strlen($pwrd) > 5){
		
		$querys="INSERT INTO login (`email_id` , `username` , `password`) VALUES ('$email' , '$username' , '$pwrd')";
		$querys=$db->query($querys);
		if($querys){
			header('Location: adminlogin.php');
			exit();
		}
		}else{
		
		echo 'ERROR : PASSWORD too Short.\n It Should Be Atleast 8 characters ';
		}
	}
	
}

?>


<div>
	<form action = "signup.php" method="post">
	<label>Username : </label><input type='text' name='username'/></br></br>
	<label>Email Id : </label><input type='text' name='emailid'/></br></br>
	<label>Password : </label><input type='password' name='pwrd'/></br></br>
	<input type="submit" name="submit" value="Create Account"/></br></br>
	
	</from>
</div>
