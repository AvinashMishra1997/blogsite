<?php

session_start();

if(!isset($_SESSION['user_id'])) {
	header('Location: adminlogin.php');
	exit();
}

include "../includes/config.php";
include "../includes/db.php";

$post_count = $db->query('SELECT * FROM posts');
$comment_count = $db->query('SELECT * FROM comments');


if(isset($_POST['submit'])){
	$newcategory=$_POST['newcategory'];
	if(!empty($newcategory)){
		$sql="INSERT INTO categories (category_name) VALUES('$newcategory')";
		$query=$db->query($sql);
		if($query){
			echo 'New Category Added';
		}else{
			echo 'ERROR Adding Category';
		}
	}else{
		echo 'MISSING : CATEGORY NAME';
	}
}else{
	echo 'ERROR WITH SUBMITTING';
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
			<div id="total_count">

					<label>Total Blog Posts : </label><?php echo $post_count->num_rows?>
					<label>Total Comments : </label><?php echo $comment_count->num_rows?>

			</div>
			<div id="new_category">
				<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
					<label for='categories'>Add New Category : </label><input type='text' name='newcategory'/>
					<input type="submit" name="submit" value="Create Category"/>
				</form>
			</div>
		
		</section>

	</body>

</html>
