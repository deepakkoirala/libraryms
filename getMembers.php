<?php
include 'includes/login-check.php';
include 'includes/database.php';

$term = mysql_real_escape_string($_REQUEST['term']); 
 $query=mysql_query("SELECT * FROM members_info where fname like '".$term."%' order by fname ");
 $json=array();
 $i =1;
    while($members=mysql_fetch_array($query)){
	
         $json[]=array(
                    
							'value'=>$i.".". $members["fname"] ." ". $members["lname"]." (" . $members["lib_id"].")"
                        
						);
		$i++;
    }
	
 echo json_encode($json);

?>