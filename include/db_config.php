<?php
//session_start 
session_start();
//default timezone 
date_default_timezone_set("asia/calcutta");
// Mysql database settings
$user		= "username";
$password	= "password";
$database	= "DB_brosena";
$host		= "localhost";

mysql_connect($host,$user,$password);
mysql_select_db($database) or die( "Unable to select database");
?>
