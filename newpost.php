<?php

session_start();

if(!isset($_SESSION['user_id'])) {
	header('Location: adminlogin.php');
	exit();
}

include "../includes/config.php";
include "../includes/db.php";

if(isset($_POST['submit'])){
	$title=$_POST['title'];
	$subtitle=$_POST['subtitle'];
	$body=$_POST['body'];
	$category=$_POST['category'];
	$title=$db->real_escape_string($title);
	$subtitle=$db->real_escape_string($subtitle);
	$body=$db->real_escape_string($body);
	$user_id=$_SESSION['user_id'];
	$date=date('d-M-Y @ G:i:s');
	$body = htmlentities($body);
	if($title && $subtitle &&$body &&$category){
	$query="INSERT INTO posts (user_id, title, subtitle, body, category_id,posted) VALUES ('$user_id','$title','$subtitle','$body','$category','$date')";
	$query=$db->query($query);
		if($query){
			echo "Post Added";
		}else{
			echo 'ERROR : Unable To Add New Post';
		}
	}else{
		echo 'ERROR : MISSING INFORMATION';
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
			<div id="menu" >
				<nav>
					<ul>
						<li><a href='userindex.php'>profile</a></li>
						<li><a href="../index.php">Main Menu</a></li>
						<li><a href='newpost.php'>Create New Post</a></li>
						<li><a href='deletepost.php'>Delete Post</a></li>
						<li><a href="logout.php">LogOut</a></li>
					</ul>
				</nav>
			</div>
			<div id="new_posts">
				<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
					<label>TITLE : </label><input type='text' name='title'/>
					<label>SUB TITLE : </label><input type='text' name='subtitle'/></br></br>
					<label>BODY : </label><textarea rows=10 cols=50 name='body'></textarea></br></br>
					<label>Category : </label><select name='category'>
					<?php
						$query=$db->query('SELECT * FROM categories');
						while($row = $query->fetch_object()){
					echo '<option Value = "'.$row->category_id.'">'.$row->category_name.'</option>';	
					}
					?></select>
					<input type="submit" name="submit" value="Create Post"/>
				</form>
			</div>
		
		</section>

	</body>
</html>


