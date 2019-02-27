<?php
 
include 'include/db_config.php';
include 'include/header.php';
if(isset($_POST['post'])){	
	mysql_query("INSERT INTO `post` values('','".$_SESSION['id']."','".$_POST['msg']."','','".date('Y-m-d H:i:s')."')");
	
	if($_FILES['file']['size']>'0'){ 
	$file_loc = $_FILES['file']['tmp_name'];
	$folder="images/";
	$file_type = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
	$file_name = mysql_insert_id().'.'.$file_type;
	move_uploaded_file($file_loc,$folder.$file_name);
	mysql_query("UPDATE post SET image='".$file_name."' WHERE id='".mysql_insert_id()."'");
	}
header("Location: /index.php");
}
//posting 
echo ' 
<div class="setting">
	<form method="post" enctype="multipart/form-data">
	<h2>Creat Post</h2>
	<textarea name="msg"></textarea>
	<label for="file"><i class="fa fa-camera"></i> Attach Photo</label>
	<input id="file" style="display:none;" type="file" name="file"></input>
	<strong><button type="submit" name="post">post</button></strong>
	</form>
</div>';

include 'include/footer.php';
?>	