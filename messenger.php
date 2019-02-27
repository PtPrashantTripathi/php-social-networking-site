<?php
include 'include/db_config.php';
include 'include/header.php';
echo '<div class="timeline">
<h2>Recent</h2>';  	
$result = mysql_query("SELECT *,COUNT(*) 'num' FROM message,profile Where (sender_id='".$_SESSION['id']."' and reciver_id=profileid) or (reciver_id='".$_SESSION['id']."' and sender_id=profileid) group by profileid");
while($row = mysql_fetch_array($result)) {
  echo '<!--img src="images/'.$row['dp'].'" width="96" height="96" style="float:left;"-->
		<h3><a href="message.php?to='.$row['profileid'].'">'.$row['username'].'</a></h3>
		<small style="float:right"> '.$row['num'].'</small><br>';
}
echo '<h2>Others</h2>';  	
$result = mysql_query("SELECT * FROM profile WHERE profile.profileid NOT IN (SELECT profileid FROM message,profile Where (sender_id='".$_SESSION['id']."' and reciver_id=profileid) or (reciver_id='".$_SESSION['id']."' and sender_id=profileid) group by profileid) and '".$_SESSION['id']."'");
while($row = mysql_fetch_array($result)) {
  echo '<!--img src="images/'.$row['dp'].'" width="96" height="96" style="float:left;"-->
		</h3><a href="message.php?to='.$row['profileid'].'">'.$row['username'].'</a></h3>
		<br>';
}
echo '
</div>';
include 'include/footer.php';
?>	 