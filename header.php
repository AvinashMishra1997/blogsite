<?php

session_start();

$query = "SELECT * FROM categories";
$categories = $db->query($query);

$id = $_SESSION['user_id'];


if($id == 1){
	$url = 'admin/adminindex.php';
}else if($id == 0){
	$url = 'admin/adminlogin.php';
}else{
	$url = 'users/userindex.php';
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
		
		<header>
			<nav>
				<a href=<?php echo $url ?>>Profile</a>
				<?php if($categories->num_rows>0){
				while($row=$categories->fetch_assoc()){ ?>
				
				<a href="index.php?category=<?php echo $row['category_id']?>"><?php echo $row['category_name']?></a>
				<?php }}?>
				<a href="admin/signup.php">Signup</a>
				<a href="admin/adminlogin.php">SignIn</a>
			</nav> 
			<div>
				<h1>BLOG NAME</h1>
				<h2>Blog About Everything</h2>
			</div>
			
		</header>
		
		
		
		<aside>
		
		</aside>
		
		
		<footer>
			
		</footer>
	</body>

</html>
