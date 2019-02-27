<?php
include 'include/db_config.php';
include 'include/header.php';
if(isset($_GET['like'])&&isset($_SESSION['id'])) {
	$sql = mysql_query("SELECT * FROM `likes` WHERE `post_id`='".$_GET['like']."' AND `liker_id`='".$_SESSION['id']."'");
	if(mysql_num_rows($sql)==1)
		mysql_query("DELETE FROM `likes` WHERE `post_id`='".$_GET['like']."' AND `liker_id`='".$_SESSION['id']."'");
	else 
		mysql_query("INSERT INTO `likes` VALUES('','".$_GET['like']."','".$_SESSION['id']."','".date('Y-m-d H:i:s')."')");
	header("Location: /tranding.php#".$_GET['like']); 
}
// Get tranding
$result = mysql_query("SELECT *,COUNT(*) as num FROM post,profile,likes Where profile.profileid=post.user_id and likes.post_id=post.id GROUP BY `post_id` ORDER BY `num` DESC LIMIT 0,10");
while($row = mysql_fetch_array($result)) {
	$sql_cmnt = mysql_query("SELECT * FROM comment Where post_id='".$row['id']."'");
	$num_cmnt = mysql_num_rows($sql_cmnt);
	$sql_like = mysql_query("SELECT * FROM `likes` Where post_id='".$row['id']."'");
	$num_like = mysql_num_rows($sql_like);echo '
<div class="timeline" id="'.$row['id'].'">
	<h3>
		<strong><a href="profile.php?id='.$row['profileid'].'">'.$row['username'].'</a></strong>
		<small> '.date("M d , h:ia",strtotime($row['msgtime'])).'</small>
	</h3>
	<p>'.$row['msg'].'</p>';
	if(!$row['image']==''){echo '<img src="images/'.$row['image'].'"/>';}
	echo '
	<span>
		<a href="?like='.$row['profileid'].'">like<i class="fa fa-thumbs-o-up"></i>'.$num_like.'</a>
		<a href="comment.php?post_id='.$row['id'].'">comment<i class="fa fa-comment"></i>'.$num_cmnt.'</a>
		<a href="like.php?post_id='.$row['id'].'" style="float:right">See more</a>
	</span>
</div>
';
}
include 'include/footer.php';
?>	
