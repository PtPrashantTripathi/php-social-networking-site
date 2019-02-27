<?php
include 'include/db_config.php';
include 'include/header.php';
if(isset($_GET['to'])) $_SESSION['to']=$_GET['to'];
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=0; }; 

if(isset($_POST['msg'])&&isset($_SESSION['id'])){  		
	mysql_query("INSERT INTO `message` VALUES('','".$_SESSION['id']."','".$_SESSION['to']."','".$_POST['msg']."','".date('Y-m-d H:i:s')."','')");
}

$result = mysql_query("SELECT * FROM profile where profileid=".$_SESSION['to']);
$user = mysql_fetch_array($result);
echo'<div class="timeline">
	<h3><a href="message.php">'.$user['username'].'</a>
	<a style="float:right" href=?page='.($page+10).'>Old Messages</a></h3><hr>';
$result = mysql_query("(SELECT * FROM message,profile Where ((sender_id='".$_SESSION['id']."' and reciver_id='".$_SESSION['to']."') or (reciver_id='".$_SESSION['id']."' and sender_id='".$_SESSION['to']."')) and sender_id=profileid ORDER BY `message`.`msg_time` DESC LIMIT $page,5)ORDER BY `msg_time`  ASC");
while($row = mysql_fetch_array($result)) {
	
echo '

<div class="msg">
  <img src="images/'.$row['dp'].'" style="width:100%;">
  <p>'.$row['msg'].'
  <small>'.date("M d , h:ia",strtotime($row['msg_time'])).'</small></p>
</div>
';
}

echo '	
	<div class="commentbox">
		<form method="post">
		<input name="msg" placeholder="Write a msg..."></input>
		<button type="submit" name="Send"><i class="fa fa-send"></i></button>
		</form>
	</div>
</div>
';
include 'include/footer.php';
?>	 