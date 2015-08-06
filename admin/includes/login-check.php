<?php 

include('includes/constants.php');
session_start();
if(!($_SESSION['fname']))
{    
	header('Location:'.site_url.'/login.php');
}
?>