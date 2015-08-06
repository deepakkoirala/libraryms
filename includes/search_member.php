<?php
echo"<table  class=\"memberajax\" border=\"1px\"align=\"center\">";
			$i = 1;
				echo"
					<thead>
						<tr>
							<th>
								SN
							</th>
							<th>
								Modify
							</th>							
							<th>
								Full Name							
							</th>
							<th>
								Library ID
							</th>
							<th>
								Mobile
							</th>
							<th>
								Email
							</th>
							<th>
								Password
							</th>
							<th>
								Address-1
							</th>
							<th>
								Address-2
							</th>
							<th>
								Father
							</th>
							<th>
								Batch
							</th>
							<th>
								Category
							</th>
							<th>
								Department
							</th>
						</tr> </thead>";
			$query = mysql_query("SELECT * from members_info WHERE fname like '$string%' or lib_id like '$string%' or department like '$string%' or category like '$string%' or email like '$string%' or lname like '$string%' or mobile_number like '$string%' or father_name like '$string%' or temporary_address like '$string%' or permanent_address like '$string%' or batch like '$string%' ");			
			while($result = mysql_fetch_array($query))
			 {
				 $j = 1;
				 echo '';											
					echo"
						<tbody>				
						<tr>
						<td>
								".$i++."</a>
							</td>
							<td>								
								<a id=\"edit\" onclick=\"return edit_mem()\" href=\"index.php?lib_id=".$result['lib_id']."&action=edit\">
									<span class=\"glyphicon glyphicon-edit\"></span>
								</a>
								 | <a id=\"edit\" onclick=\"return del_mem()\" href=\"index.php?lib_id=".$result['lib_id']."&action=del\">
									<span class=\"glyphicon glyphicon-remove\"></span>															
							</td>
							
							<td><a href=\"index.php?action=memberstatus&libid=".$result['lib_id']."\" target=\"_top\">
								".$result['fname']." ".$result['lname']." </a>
							<td>
								".$result['lib_id']."
							</td>
							<td>							
								".$result['mobile_number']."
							</td>
							<td><a  title=\"Send Email to $result[1]\"href=\"mailto:$result[5]?Subject=Message From Librarian\">
								".$result['email']."
							</td>
							<td>
								".$result['password']."
							</td>
							<td>
								".$result['temporary_address']."
							</td>
							<td>
								".$result['permanent_address']."
							</td>
							<td>
								".$result['father_name']."
							</td>
							<td>
								".$result['batch']."
							</td>
							<td>
								".$result['category']."
							</td>
							<td>
								".$result['department']."
							</td>
						</tr></tbody>";											
		}
		if(!mysql_num_rows($query))
		{
			echo "<tr><td colspan=14><center><span style=\"color:white;\">No Such Member Exists !</span></center></td></tr></tbody>";
			echo "</table>";		
		}	
    ?>