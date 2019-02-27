<?php
include 'include/db_config.php';
include 'include/header.php';
?>
 
<div class="search">
    <form method="GET">
		<input type="text" name="q" placeholder="Search for names.."/>
		<button type="submit"><i class="fa fa-search"></i>Search</button>
	</form>
<ul>
<?php
if(isset($_GET['q'])) {
$result = mysql_query("SELECT * FROM profile WHERE username LIKE '%".$_GET['q']."%'");
while($row = mysql_fetch_array($result)) {
  echo '<li>
			<a href="profile.php?id='.$row['profileid'].'">
			<img src="images/'.$row['dp'].'" width="96" height="96">
			'.$row['username'].'
			</a>
		</li>';
}
}
?>
</ul>
</div>
<?php
	include 'include/footer.php';
?>	