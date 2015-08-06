<div class="user_manager manager_wrapper">
<h3 class="manager_sub_title"><center>Staff Manager Section</center></h3>
<?php 
	if(isset($_GET['action']))
	{
    	$action = $_GET['action'].'-staff.php';
	    include('pages/staff-manager/'.$action);     
	  }
	  else
	  {
	    include('pages/staff-manager/list-staff.php'); 
	  }
?>
</div>
