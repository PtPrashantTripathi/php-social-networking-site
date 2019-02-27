<?php
//session_start 
session_start();
//default timezone 
date_default_timezone_set("asia/calcutta");
// Mysql database settings
$user		= "b24_22361550";
$password	= "137416114";
$database	= "b24_22361550_brosena";
$host		= "sql205.byethost.com";

mysql_connect($host,$user,$password);
mysql_select_db($database) or die( "Unable to select database");
?>