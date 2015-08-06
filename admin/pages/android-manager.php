<div class="user_manager manager_wrapper">
<h3 class="manager_sub_title"><center>Android Clients :: Book Wishlisht</center></h3>
<?php 	
	if(isset($_GET['action']))
	{
    	$action = $_GET['action'].'-wishlists.php';
	    include('pages/android-manager/'.$action);     
	  }
	  else
	  {
		$UpdateSeen = mysql_query("UPDATE wishlists_info set seen_status = 1 where seen_status = 0");
	    include('pages/android-manager/list-wishlists.php'); 
	  }
?>
</div>
