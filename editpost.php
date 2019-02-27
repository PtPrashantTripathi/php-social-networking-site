<?php
include 'include/db_config.php';
include 'include/cookies_config.php';
include 'include/session_config.php';
include 'include/header.php';

if(isset($_POST['editpost'])){	
	mysql_query('UPDATE `post` SET `msg`="'.$_POST['msg'].'" Where user_id='.$_SESSION['id'].' and id='.$_GET['post_id']);
	
	if($_FILES['file']['size']>'0'){ 
	$file_loc = $_FILES['file']['tmp_name'];
	$folder="images/";
	$file_type = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
	$file_name = $_GET['post_id'].'.'.$file_type;
	move_uploaded_file($file_loc,$folder.$file_name);
	mysql_query("UPDATE `post` SET `image`='".$file_name."' Where user_id=".$_SESSION['id']." and id=".$_GET['post_id']);
	}
	//header("Location: /index.php");
}

$result = mysql_query('SELECT * FROM post Where user_id='.$_SESSION['id'].' and id='.$_GET['post_id']);
$row = mysql_fetch_array($result);
echo '
<div class="timeline">
	<form method="post" enctype="multipart/form-data">
	<strong><a href="creatpost.php">Make Post <i class="fa fa-pencil"></i></a></strong>
	<textarea name="msg">'.$row['msg'].'</textarea>
	<input id="file" style="display:none;" type="file" name="file"></input>	
	<label for="file">';
	if(!$row['image']==''){echo '<img src="images/'.$row['image'].'"/>';}
	else{echo '<img src="images/camera.png"/>';}
echo '</label>
	<button type="submit" name="editpost">post</button>
	</form>
</div>';

?>
