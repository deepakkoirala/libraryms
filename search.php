<?php
require 'includes/login-check.php';
	
$input = $_GET['id'];
$string = trim($input);

include('includes/database.php');
include('includes/search_member.php');
include('includes/search_book.php');	
?>
