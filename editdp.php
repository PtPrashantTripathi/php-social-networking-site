<?php

include 'include/db_config.php';
include 'include/session_config.php';
include 'include/header.php';
  
$sql = mysql_query("SELECT * FROM profile WHERE profileid='".$_SESSION['id']."'");	
$user = mysql_fetch_array($sql);
	
if(isset($_POST['uplode']))
  {  		
	$file_loc = $_FILES['file']['tmp_name'];
	$folder="images/";
	$file_type = pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
	$file_name = $user['username'].'.'.$file_type;
  if(move_uploaded_file($file_loc,$folder.$file_name))
	{
	   mysql_query("UPDATE profile SET dp='".$file_name."' WHERE profileid='".$_SESSION['id']."'");
	   echo "<script>alert('Suceesfully Uploded !!!');</script>";
	   header("Location: profile.php?success");
	}
  else
	{
	   echo "<script>alert('Someting Error !!!');</script>";
	}
  }
?>

<div class="setting">
	<form method="post" enctype="multipart/form-data">
	<center>
	<label for="file">
	<h2>Upload Your Profile Pic</h2>
	<image src="images/<?=$user['dp'];?>"></img>
	</label>
	<br>
	<input id="file" style="display:none;" type="file" name="file"/>
	<button type="submit" name="uplode">upload</button>
	</center>
	</form>
</div>
