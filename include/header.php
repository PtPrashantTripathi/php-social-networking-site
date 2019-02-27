<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="title" content="BroSena" />
	<meta name="description" content="Pt. Prashant Triapthi Jabalpur (Madhya Pradesh), India.  " />
	<meta name="keywords" content="Pt. Prashant Tripathi ,Brosena.ga,brosena,social networking ,Prashant Triapthi ,Pandit, Prashant Tripathi , St. Aloysius institute of technology , web developer, software engineer, Astrology, Personal website" />
	<meta name="author" content="Pt. Prashant Tripathi" />
	<meta name="language" content="English">
	<meta name="copyright" content="Pt. Prashant Tripathi © 2018 " />
	<meta name="robots" content="index, follow">
	<meta http-equiv="imagetoolbar" content="yes">
    <link rel="shortcut icon" href="/image/brosena.png">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></head>
<body>
<div class="header">
	<ul>
		<li><a href="/"><img src="/images/brosena.png" style="width:42px;height:42px;border:0;float:left;"/></a></li>	
		<li><a href="trending.php"><i class="fa fa-star"></i>Top</a></li>
		<li><a href="search.php"><i class="fa fa-search"></i>Search</a></li>
		<?php if(isset($_SESSION['id'])) {?>
		<li><a href="creatpost.php"><i class="fa fa-edit"></i>Post</a></li>
		<li><a href="profile.php?self"><i class="fa fa-user"></i>Profile</a></li>
		<li><a href="messenger.php"><i class="fa fa-comments"></i>Chat</a></li>
		<li><a href="setting.php"><i class="fa fa-cog"></i>Setting</a></li>
		<li style="float:right;"><a href="logout.php"><i class="fa fa-power-off"></i>Logout</a></li>
		<?php }	else{?>
		<li style="float:right;/*font-size:70%;*/"><a href="login.php">login</a></li>
		<?	}?>
		</ul>
</div>
