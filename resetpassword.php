<?php
include 'include/db_config.php';
include 'include/cookies_config.php';
include 'include/session_config.php';
include 'include/header.php';


if (isset($_POST['change']) && $_POST['new']==$_POST['verifiy']){
		$pass=$_POST['new'];
		$old=$_POST['old'];
		mysql_query("UPDATE profile SET password='$pass' where password='$old' and profileid=".$_SESSION['id']);
		echo "<script>alert('Successful');</script>";
		header("Location: logout.php");
}

	
echo '
<div class="setting">
<form method="post">
<h2>Change Password</h2>
<h3>Old Password</h3>
<input name="old" placeholder="Old Password"/>
<h3>Enter New Password</h3>
<input name="new" placeholder="New Password"/>
<h3>Re-type new password</h3>
<input name="verifiy" placeholder="Re-type new password"/>
<center>
<button type="submit" name="change">Change Password</button>
</center>
</form>
</div>
';
include 'include/footer.php';
?>	