<?php

session_start();

if(!isset($_SESSION['user_id'])) {
	header('Location: ../admin/adminlogin.php');
	exit();
}

include "config.php";
include "db.php";

$post = $_GET['post'];


$query = "SELECT  `post_id`, `user_id`, `title`, `subtitle`, `body`, `category_id`, `posted` FROM posts WHERE posts.post_id = '$post' ";
$query3 = $db->query($query);



?>

<?php include "header.php";?>

<section>
			<div id="single_content">
				<?php if($row = $query3->num_rows){
					 while($row = $query3->fetch_object() ){ 
					 $category = $db->query("SELECT * FROM categories WHERE categories.category_id = '$row->category_id'");
					 $category = $category->fetch_object();
						?>
					<article>
					
						<hgroup>
							</br></br></br>
							<h1><?php  echo $row->title;?></h1>
							<h2><?php  echo $row->subtitle;?></h2>
						<label>Category : </label><a href = "index.php?category=<?php echo $category->category_id ?>"><?php echo ($category->category_name)?></a>	
						</hgroup>
						<p><?php echo $row->body ?></p>
						
						
					</article>
				<?php } }?>
			</div>
		
		</section>

<?php include "comment.php";?>
		
		
		
