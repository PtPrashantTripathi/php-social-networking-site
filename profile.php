<?php
include 'include/db_config.php';
include 'include/header.php';
if(isset($_GET['id']))
	$id=$_GET['id'];
else if(isset($_SESSION['id']))
	$id=$_SESSION['id'];
else
	$id=1;
//user data
$result = mysql_query("SELECT * FROM profile where profileid=".$id);
$user = mysql_fetch_array($result);
echo '<div class="profile">
	<center>';
	if($id==$_SESSION['id']){echo'<a href="editdp.php"><img src="images/'.$user['dp'].'"></img></a><h3>'.$user['username'].'</h3>';}
else{echo'<img src="images/'.$user['dp'].'"></img><h3>'.$user['username'].' <a href="message.php?to='.$id.'"><i class="fa fa-comments"></i>Message</a></h3>';}
echo '</center></div>';
if(isset($_GET['like'])&&isset($_SESSION['id'])) {
	$sql = mysql_query("SELECT * FROM `likes` WHERE `post_id`='".$_GET['like']."' AND `liker_id`='".$_SESSION['id']."'");
	if(mysql_num_rows($sql)==1)
		mysql_query("DELETE FROM `likes` WHERE `post_id`='".$_GET['like']."' AND `liker_id`='".$_SESSION['id']."'");
	else 
		mysql_query("INSERT INTO `likes` VALUES('','".$_GET['like']."','".$_SESSION['id']."','".date('Y-m-d H:i:s')."')");
}
if(isset($_GET['del'])&&isset($_SESSION['id'])){
		mysql_query('DELETE FROM `post` WHERE `id` ='.$_GET['del'].' and `user_id`='.$_SESSION['id']);
		echo "<script>alert('Successful');</script>";
}  
// Get users post
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=0; }; 
$result = mysql_query("SELECT * FROM post,profile Where profile.profileid=post.user_id and post.user_id='$id' ORDER BY  post.msgtime DESC LIMIT $page , 10");
while($row = mysql_fetch_array($result)) {
	$sql_cmnt = mysql_query("SELECT * FROM comment Where post_id='".$row['id']."'");
	$num_cmnt = mysql_num_rows($sql_cmnt);
	$sql_like = mysql_query("SELECT * FROM `likes` Where post_id='".$row['id']."'");
	$num_like = mysql_num_rows($sql_like);echo '<div class="timeline" id="'.$row['id'].'">
	<h3>
		<strong><a href="profile.php?id='.$row['profileid'].'">'.$row['username'].'</a></strong>
		<small> '.date("M d , h:ia",strtotime($row['msgtime'])).'</small>';
if($id==$_SESSION['id']){echo'<a style="float:right;" href="?del='.$row['id'].'"><i class="fa fa-trash-o"></i>&nbsp;</a>
		<a style="float:right;" href="editpost.php?post_id='.$row['id'].'"><i class="fa fa-cog"></i>&nbsp;</a>';}
echo '</h3>
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