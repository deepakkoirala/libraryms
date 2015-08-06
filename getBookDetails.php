<?php
 include 'includes/login-check.php';
 include 'includes/database.php';

	 $an = mysql_real_escape_string($_REQUEST['an']); 
	 $query = mysql_query("SELECT * FROM books_info where accession_no = '$an' ");
	 $rows = array();
	
	 while($r = mysql_fetch_assoc($query))
	{	
		$rows= $r;					
	}
	echo json_encode($rows);	

?>