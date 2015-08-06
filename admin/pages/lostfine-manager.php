<div class="user_manager manager_wrapper">
<h3 class="manager_sub_title"><center>Lost and Fine Managing Section</center></h3>
<?php
	if(isset($_GET['action']))
	{
    	$action = $_GET['action'].'-lost.php';
	    include('pages/lostfine-manager/'.$action);     
	}
	  else
	 {		
	    include('pages/lostfine-manager/list-lost.php'); 
	 }
?>
</div>
