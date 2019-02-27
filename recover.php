<?php
include 'include/db_config.php';
include 'include/header.php';
include 'include/way2sms-api.php';

if(isset($_GET['send'])){
	$sql = mysql_query("SELECT * FROM `profile` WHERE profileid=".$_GET['send']);
	$sms = mysql_fetch_array($sql);
	$data='Hello '.$sms['username'].' Your Old Password is '.$sms['password'].'  http://Brosena.ga created by: Pt. Prashant tripathi ';	
	sendWay2SMS ($sms['contactno'],$data);   
	echo '<script>alert("Your Password Succesfully send on Your Contanct");window.location = "index.php";</script>';
	
}
else if(isset($_GET['no'])) {
$result = mysql_query("SELECT * FROM profile WHERE `contactno` LIKE '%".$_GET['no']."'");
$user = mysql_fetch_array($result);
$rows = mysql_num_rows($result);
if($rows==1){echo '	
     <div class="setting">
		<center>
		<h2>'.$user['username'].'</h2>
		<img src="images/'.$user['dp'].'">
		<h3>We Will Send code via SMS on '.$user['contactno'].'</h3>
		<a href="?send='.$user['profileid'].'"><button>Proceed</button></a>   
		<a href="recover.php"><button>Not My Account</button></a>
		<center>
	</div>
';}
else echo '<div class="error">Sorry this no is not Registered.<a href="recover.php">Click Here to try again</a></div>';
}
else{	
echo '
<div class="setting">	
	<form method="get">
	<h2>Password Recovery</h2>
	<h3>Please enter your Contact no. to search for your account.</h3>
	<input type="text" name="no" placeholder="Contact No .."/>
	<button type="submit">Search Account</button>
	</form>
</div>';
}
include 'include/footer.php';
?>	