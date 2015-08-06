<?php 
$id = stripslashes($_GET['id']);
$_SESSION['id'] = $id;

$found = mysql_fetch_array(mysql_query("SELECT * from lostbooks where id = $id"));

if(is_array($found)){
	    $_SESSION['msg'] = '<font color="red">The Book has been Restored back to the Library !</font>';
        echo "<script> window.location =\"".site_url."/index.php?action=edit&an=".$found['book']."&next=admin/index.php?page=lostfine-manager\"; </script>";
}
else{
       $_SESSION['msg'] = 'Error :  <font color="red">Could not Complete at the Moment. Try Later!</font>';
       echo "<script> window.location =\"".site_url."/admin/index.php?page=lostfine-manager\"; </script>";
}
?>