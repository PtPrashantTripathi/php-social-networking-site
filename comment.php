<?php
include 'include/db_config.php';
include 'include/header.php';
  	
if(isset($_GET['like'])&&isset($_SESSION['id'])) {
	$sql = mysql_query("SELECT * FROM `likes` WHERE `post_id`='".$_GET['like']."' AND `liker_id`='".$_SESSION['id']."'");
	if(mysql_num_rows($sql)==1)
		mysql_query("DELETE FROM `likes` WHERE `post_id`='".$_GET['like']."' AND `liker_id`='".$_SESSION['id']."'");
	else 
		mysql_query("INSERT INTO `likes` VALUES('','".$_GET['like']."','".$_SESSION['id']."','".date('Y-m-d H:i:s')."')");
	header("Location: /comment.php#".$_GET['like']); 
}
if(isset($_POST['comment'])&&isset($_SESSION['id'])){  		
	mysql_query("INSERT INTO `comment` VALUES('','".$_GET['post_id']."','".$_SESSION['id']."','".$_POST['cmnt']."','".date('Y-m-d H:i:s')."')");
}
$result = mysql_query("SELECT * FROM post,profile Where profile.profileid=post.user_id and post.id=".$_GET['post_id']);
while($row = mysql_fetch_array($result)) {
	$sql_cmnt = mysql_query("SELECT * FROM comment Where post_id='".$row['id']."'");
	$num_cmnt = mysql_num_rows($sql_cmnt);
	$sql_like = mysql_query("SELECT * FROM `likes` Where post_id='".$row['id']."'");
	$num_like = mysql_num_rows($sql_like);
echo '
<div class="timeline" id="'.$row['id'].'">
	<h3>
		<strong><a href="profile.php?id='.$row['profileid'].'">'.$row['username'].'</a></strong>
		<small> '.date("M d , h:ia",strtotime($row['msgtime'])).'</small>
	</h3>
	<p>'.$row['msg'].'</p>';
	if(!$row['image']==''){echo '<img src="images/'.$row['image'].'"/>';}
	echo '<span>
			<a href="?like='.$row['id'].'">like<i class="fa fa-thumbs-o-up"></i>'.$num_like.'</a>
			<a href="comment.php?post_id='.$row['id'].'">comment<i class="fa fa-comment"></i>'.$num_cmnt.'</a>
			<a href="like.php?post_id='.$row['id'].'" style="float:right">See more</a>
		 </span>';
}	$result = mysql_query("SELECT * FROM comment,profile Where profile.profileid=comment.cmnter_id and comment.post_id='".$_GET['post_id']."' ORDER BY `comment`.`cmnt_time` ASC LIMIT 0 , 30");
while($row = mysql_fetch_array($result)) {
	
echo '
	<div class="comment">
		<a href="profile.php?id='.$row['profileid'].'">'.$row['username'].'</a>
		<small> '.date("M d , h:ia",strtotime($row['cmnt_time'])).'</small>
		<p>'.$row['comment'].'</p>
	</div>';
}echo '	
	<div class="commentbox">
		<form method="post">
		<input name="cmnt" placeholder="Write a comment..."></input>
		<button type="submit" name="comment">Comment</button>
		</form>
	</div>
</div>
';
include 'include/footer.php';
?>	 