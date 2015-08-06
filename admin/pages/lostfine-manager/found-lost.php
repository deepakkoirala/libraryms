<?php 
include 'log.php';
unset($_SESSION['go']);
if($_SESSION['id'])
{
	$id = $_SESSION['id'];
}
else
{
	$id = stripslashes($_GET['id']);
}
unset($_SESSION['id']);
$found = mysql_fetch_array(mysql_query("SELECT * from lostbooks where id = $id"));

$update_books_info = mysql_query("UPDATE books_info set status = '',flag = 1 where accession_no = '".$found['book']."'");
$update_issued = mysql_query("DELETE from issued  where accession_no = '".$found['book']."'");
$update_lostbook = mysql_query("DELETE from lostbooks where id = $id");


if($update_books_info and $update_issued and $update_lostbook){

	$res = mysql_fetch_array(mysql_query("SELECT * from books_info where accession_no = ".$found['book'].""));
	$action = "Found_Book";
	$item = $found['book'];
	$desc = "Restore Success for Book:".getJSON($res);
	logAdmin($action,$item,$desc);		
	logSystem($action,$item,$desc);
	logStaff($action,$item,$desc);		

    $_SESSION['msg'] = 'Book has been Restored Back to the Library';
	
    echo "<script> window.location =\"".site_url."/admin/index.php?page=lostfine-manager\"; </script>";
}
else
{
	$_SESSION['msg'] = 'Operation Unsuccessful ! Try Later';
    echo "<script> window.location =\"".site_url."/admin/index.php?page=lostfine-manager\"; </script>";
}
?>