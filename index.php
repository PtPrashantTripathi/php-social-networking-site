<?php

include 'include/db_config.php';
include 'include/cookies_config.php';
//include 'include/session_config.php';
include 'include/header.php';
if(isset($_GET['like'])) {
	$sql = mysql_query("SELECT * FROM `likes` WHERE `post_id`='".$_GET['like']."' AND `liker_id`='".$_SESSION['id']."'");
	if(mysql_num_rows($sql)==1)
		mysql_query("DELETE FROM `likes` WHERE `post_id`='".$_GET['like']."' AND `liker_id`='".$_SESSION['id']."'");
	else 
		mysql_query("INSERT INTO `likes` VALUES('','".$_GET['like']."','".$_SESSION['id']."','".date('Y-m-d H:i:s')."')");
	header("Location: /index.php#".$_GET['like']); 
}

  echo ' 
<div class="timeline">
	<form action="creatpost.php" method="post" enctype="multipart/form-data">
	<strong><a href="creatpost.php">Make Post <i class="fa fa-pencil"></i></a></strong>
	<textarea name="msg" placeholder = "Whats your mood?"></textarea>
	<span>
	<label for="file"><i class="fa fa-camera"></i> Attach Photo</label>
	<input id="file" style="display:none;" type="file" name="file"></input>
	<button type="submit" name="post">post</button>
	</span>
	</form>
</div>';
// Get randomly
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=0; }; 
$result = mysql_query("SELECT * FROM post,profile Where profile.profileid=post.user_id ORDER BY  post.msgtime DESC LIMIT $page , 10");
while($row = mysql_fetch_array($result)) {
	$sql_cmnt = mysql_query("SELECT * FROM comment Where post_id='".$row['id']."'");
	$num_cmnt = mysql_num_rows($sql_cmnt);
	$sql_like = mysql_query("SELECT * FROM `likes` Where post_id='".$row['id']."'");
	$num_like = mysql_num_rows($sql_like);
echo '

<div class="timeline" id="'.$row['id'].'">
	<h3> 
		<strong><a href="profile.php?id='.$row['profileid'].'">'.$row['username'].'</a></strong>
		<small> '.date("M d , h:ia",strtotime($row['msgtime'])).'</small>';
	if($row['profileid']==$_SESSION['id']){
	echo'<a href="editpost.php?post_id='.$row['id'].'"><i style="float:right;" class="fa fa-cog"></i></a>';}
	echo '
	</h3>
	<p>'.$row['msg'].'</p>';
	if(!$row['image']==''){echo '<img src="images/'.$row['image'].'"/>';}
	echo '
	<span>
		<a href="?like='.$row['id'].'">like<i class="fa fa-thumbs-o-up"></i>'.$num_like.'</a>
		<a href="comment.php?post_id='.$row['id'].'">comment<i class="fa fa-comment"></i>'.$num_cmnt.'</a>
		<a href="like.php?post_id='.$row['id'].'" style="float:right">See more</a>
	</span>
</div>
';
}
$page=$page+10;
echo '<span class="refresh"><i class="fa fa-arrow-circle-right"></i><a href=?page='.$page.'>Next page</a></span>';
include 'include/footer.php';
?>	