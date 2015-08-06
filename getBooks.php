<?php
include 'includes/login-check.php';
include 'includes/database.php';

$term = mysql_real_escape_string($_REQUEST['term']); 
$query=mysql_query("SELECT * FROM books_info where title like '".$term."%' or accession_no like '".$term."%' having flag = 1 and status not in('lost') order by title ");

 $json=array();
 $i=1;
 while($books=mysql_fetch_array($query)){
	 $type = $books['type'];
	 if($type == "Reference"){
	
         $json[]=array(
                    
							'value'=> $i.".".$books["title"] ." (" . $books["accession_no"].") <Reference Book>"
                        
						);
						$i++;
	 }else
	 {
		  $json[]=array(
                    
							'value'=> $i.".".$books["title"] ." (" . $books["accession_no"].")"
                        
						);
						$i++;
	}
    }
	
 echo json_encode($json);

?>