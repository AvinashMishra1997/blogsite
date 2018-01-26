<?php

session_start();

if(!isset($_SESSION['user_id'])) {
	header('Location: adminlogin.php');
	exit();
}

include "../includes/config.php";
include "../includes/db.php";

$id = $_SESSION['user_id'] ;
$post_count = $db->query("SELECT * FROM posts WHERE `posts`.`user_id` = '$id'");
$comment_count = $db->query("SELECT * FROM comments WHERE `comments`.`user_id` = '$id'");



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
						<li><a href='userindex.php'>Profile</a></li>
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
			
		
		</section>

	</body>

</html>
