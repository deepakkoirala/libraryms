<div class="user_manager manager_wrapper">
<h3 class="manager_sub_title"><center>Library Constants Managing Section</center></h3>
<?php 
	if(isset($_GET['action']))
	{
    	$action = $_GET['action'].'-constants.php';
	    include('pages/libcons-manager/'.$action);     
	  }
	  else
	  {
	    include('pages/libcons-manager/list-constants.php'); 
	  }
?>
</div>
