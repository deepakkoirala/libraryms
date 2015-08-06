<?php 
error_reporting(0);
$connect = mysql_connect(HOST,USER,PASS) or die(mysql_error());
$link = mysql_select_db(DBNAME) or die(mysql_error());

?>