<?php include 'log.php';
?>
<div class="user_manager manager_wrapper">
<h3 class="manager_sub_title"><center>Core Manager Section</center></h3>
<?php 	
	
	if(isset($_GET['action']))
	{
    	$action = $_GET['action'].'.php';
	    include('pages/core-manager/'.$action);     
	  }
	  else
	  {
	    include('pages/core-manager/list-core.php'); 
	  }
?>
</div>
