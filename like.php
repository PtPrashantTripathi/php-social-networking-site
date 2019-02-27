<?php
include 'include/db_config.php';
include 'include/header.php';
echo '
<div class="liker">
	<ul>';  	
if(isset($_GET['post_id'])) {
$result = mysql_query("SELECT * FROM profile, likes WHERE profile.profileid = likes.liker_id AND likes.post_id =".$_GET['post_id']);
while($row = mysql_fetch_array($result)) {
  echo '<li>
			<a href="profile.php?id='.$row['profileid'].'">
			<img src="images/'.$row['dp'].'" width="96" height="96">'.$row['username'].'
			</a>
			<small style="float:right"> '.date("M d , h:ia",strtotime($row['like_time'])).'</small>
		</li>';
}
}
echo '
	</ul>
</div>';
include 'include/footer.php';
?>	 