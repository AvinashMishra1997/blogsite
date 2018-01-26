<?php

session_start();

if(!isset($_SESSION['user_id'])) {
	header('Location: ../admin/adminlogin.php');
	exit();
}

include "config.php";
include "db.php";

$post = $_GET['post'];

$post_info = "SELECT  `post_id` FROM posts WHERE posts.post_id = '$post' ";
$posts_info = $db->query($post_info);

$posts_info = $posts_info->fetch_object();
$posts_info = $posts_info->post_id;



$comments = $db->query("SELECT * FROM comments WHERE `comments`.`post_id`= '$posts_info' ORDER BY comment_id DESC ");


?>

<?php include "header.php";?>


<?php
					$counter = 0;
					while($row=$comments->fetch_object()){
					
					
				?>
				</br></br><label>USERNAME : </label><?php echo $row->username ; ?></br>
				<label>COMMENT : </label><?php echo $row->comment ; ?></br>
				<label>Posted On : </label><?php echo $row->posted_on ; ?></br></br></br>
				
				<?php   } ?>
			
			
			
			
