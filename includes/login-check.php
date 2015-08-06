<?php 

session_start();
include('includes/constants.php');
if(!($_SESSION['fname']))
{    
	header('Location:'.site_url.'/login.php');
}
?>