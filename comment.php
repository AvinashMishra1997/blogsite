<?php




$post = $_GET['post'];

$post_info = "SELECT  `post_id` FROM posts WHERE posts.post_id = '$post' ";
$posts_info = $db->query($post_info);

$posts_info = $posts_info->fetch_object();
$posts_info = $posts_info->post_id;



if(isset($_POST['submit'])){
	$comment = $_POST['comment'];
	$comment = $db->real_escape_string($comment);
	$comment = htmlentities($comment);
	$user_id=$_SESSION['user_id'];
	
	$login_info = $db->query("SELECT * FROM login WHERE `login`.`user_id`='$user_id'");
	if($login_info->num_rows > 0){
		$login_info = $login_info->fetch_object();
		$login_info = $login_info->username;
		
	}
	
	$date=date('d-M-Y @ G:i:s');
	
	if($comment){

		$query="INSERT INTO comments (post_id, user_id, username, comment, posted_on) VALUES ('$posts_info','$user_id','$login_info','$comment','$date')";
	$query=$db->query($query);
	

	}else{

		echo 'ERROR : Missing Comment';
	}
	
	
}


$comments_query = $db->query("SELECT * FROM comments WHERE `comments`.`post_id`='$posts_info' ORDER BY comment_id DESC ");

?>




<div id = "comments" >
				<form action = "<?php echo $_SERVER['PHP_SELF'].'?post='.$posts_info ; ?>" method="post">
					</br></br><label>Comment : </label><input type =  'text' name = 'comment' /></br></br>
					
					
					<input type='submit' name= 'submit' value = 'PostComment' />
				
				</form>
</div id="the_comments">
<div>
				<?php
					$counter = 0;
					while($row=$comments_query->fetch_object()){
					if($counter <5){
					
				?>
				</br></br><label>USERNAME : </label><?php echo $row->username ; ?></br>
				<label>COMMENT : </label><?php echo $row->comment ; ?></br>
				<label>Posted On : </label><?php echo $row->posted_on ; ?></br></br></br>
				
				<?php $counter++; }else{
					break;
				}  } ?>
			
				
</div>
			
			<div>
					<a href="comments.php?post=<?php echo $posts_info ?>"><input type = 'submit' name = 'submit' value = 'ReadAllComments'></input><a/>
			</div>
			
			
