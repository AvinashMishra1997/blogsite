<?php

include "includes/config.php";
include "includes/db.php";



if(isset($_GET['category'])){
$category = $_GET['category'];
}else{
$category = 1;
}

if($category >1){
$query2 = $db->query("SELECT  `post_id`, `user_id`, `title`, `subtitle`, `body`, `category_id`, `posted` FROM posts WHERE posts.category_id = '$category' ORDER BY post_id DESC");
}else{
$query2 = $db->query('SELECT * FROM posts ORDER BY post_id DESC');
}


?>

<?php include "includes/header.php";?>

<section>
			<div id="main_content">

				<?php if($row = $query2->num_rows){
					 while($row = $query2->fetch_object() ){ 
					 $category = $db->query("SELECT * FROM categories WHERE categories.category_id = '$row->category_id'");
					 $category = $category->fetch_object();
						?>
					<article>
					
						<hgroup>
							
							<a href="includes/single.php?post=<?php echo $row->post_id; ?>"><h1><?php  echo $row->title;?></h1></a>
							<h2><?php  echo $row->subtitle;?></h2>
						<label>Category : </label><a href = "index.php?category=<?php echo $category->category_id ?>"><?php echo ($category->category_name)?></a>	
						</hgroup>
						<p><?php echo substr($row->body,0,500).'<strong>...</strong>' ?></p><a href="includes/single.php?post=<?php echo $row->post_id; ?>"><input type='submit' name='submit' value="Read More"/></a>
						
						
					</article>
				<?php } }?>
			</div>
		
		</section>
