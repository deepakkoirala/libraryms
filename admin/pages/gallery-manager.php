<div class="user_manager manager_wrapper">
<h3 class="manager_sub_title"><center>Books and Members Gallery</center></h3>
<?php 
	if(isset($_GET['action']))
	{
    	$action = $_GET['action'].'-gallery.php';
	    include('pages/gallery-manager/'.$action);     
	  }
	  else
	  {
	    include('pages/gallery-manager/list-gallery.php'); 
	  }
?>
</div>
