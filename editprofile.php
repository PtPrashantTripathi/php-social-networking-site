<?php
include 'include/db_config.php';
include 'include/cookies_config.php';
include 'include/session_config.php';
include 'include/header.php';

//user data
$result = mysql_query("SELECT * FROM profile where profileid=".$_SESSION['id']);
$user = mysql_fetch_array($result);

if (isset($_POST['change'])) {
 	if ($_POST['username']=='') $username=$user['username'];
	else $username = $_POST['username'];
	
	if ($_POST['contactno']=='') $contactno = $user['contactno'];
	else $contactno=$_POST['contactno'];
	
	$gender = $_POST['gender'];
	if(mysql_query("UPDATE profile SET username='$username',contactno='$contactno',gender='$gender' where profileid=".$_SESSION['id'])){
		echo "<script>alert('Successful');</script>";
		header("Location: editprofile.php");
		}
	else{
		echo "<script>alert('Somthing Missing !!!');</script>";
		}
}

	
echo '
<div class="setting">
<form method="post">
<h2>Update Your Profile</h2>
<h3>User Name:<strong>'.$user['username'].'</strong></h3>
<input type="text" name="username" placeholder="New User Name"/>
<h3>Contect No.:<strong>'.$user['contactno'].'</strong></h3>
<input type="text" name="contactno" placeholder="New Mobile No"/>';
if($user['gender']=='m'){
echo '
<h3>Gender:<strong>Male</strong></h3>
<select name="gender">
  <option value="m" selected>Male</option>
  <option value="f"> Female</option>
</select>  ';}
else{echo '
<h3>Gender:<strong>Female</strong></h3>
<select name="gender">
  <option value="m">Male</option>
  <option value="f" selected> Female</option>
</select>  ';}
echo '<center>
<button type="submit" name="change">Change</button>
</form>
</div>
';
include 'include/footer.php';
?>	