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
	$category=$_POST['category'];
	$title=$db->real_escape_string($title);
	$category=$db->real_escape_string($category);
	$title=htmlentities($title);
	$category=htmlentities($category);
	$query="SELECT post_id FROM posts WHERE title='$title' AND category_id='$category'";
	$query=$db->query($query);
	if($query->num_rows === 1){
		while($row = $query->fetch_object()){
			$post_id=$row->post_id;
		}
		$query=$db->query("DELETE FROM posts WHERE `posts`.`post_id`='$post_id'");
		echo 'POST DELETED';
	}else{
		echo 'ERROR : POST Doesn\'t Exists ';
	}
	
}else{
	echo 'ERROR With Submitting';
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
						<li><a href='adminindex.php'>Profile</a></li>
						<li><a href="../index.php">Main Menu</a></li>
						<li><a href='newpost.php'>Create New Post</a></li>
						<li><a href='deletepost.php'>Delete Post</a></li>
						<li><a href="logout.php">LogOut</a></li>
						
					</ul>
				</nav>
			</div>
			<div id="delete_posts">
				<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
					<label>TITLE : </label><input type='text' name='title'/></br></br>
					
					<label>Category : </label><select name='category'>
					<?php
						$query=$db->query('SELECT * FROM categories');
						while($row = $query->fetch_object()){
					echo '<option Value = "'.$row->category_id.'">'.$row->category_name.'</option>';	
					}
					?></select></br></br>
					<input type="submit" name="submit" value="Delete Post"/>
				</form>
			</div>
		
		</section>

	</body>
</html>


