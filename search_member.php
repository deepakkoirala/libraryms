<?php 
	include 'includes/dependencies.php';
			echo"<table  class=\"memberajax\" border=\"1px\"align=\"center\">";
			$i = 1;
				echo"<thead>
						<tr>
							<th>
								SN
							</th>
							<th>
								Modify
							</th>							
							<th>
								FullName								
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
						</tr></thead>";
			$query = mysql_query("SELECT * from members_info WHERE fname like '$string%' or lib_id like '$string%' or department like '$string%' or category like '$string%' or email like '$string%' or lname like '$string%' or mobile_number like '$string%' or father_name like '$string%' or temporary_address like '$string%' or permanent_address like '$string%' or batch like '$string%' order by fname ");			
			while($result = mysql_fetch_array($query))
			 {													
				echo"<tbody>			
					<tr>
					<td>
							".$i++."</a>
						</td>
						<td>";
?>				
 <div class="dropdown">
  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
    Action
    <span class="caret"></span>
  </button>
	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    	<li role="presentation">
    		<b>
        		Action
	        </b>
    	</li>
	    <li role="presentation" class="divider">
    	</li>	
	    <li role="presentation">		
			<a  id="edit" onclick="return del_mem()" href="index.php?action=del&lib_id=<?php echo $result['lib_id'];?>">
				<span class="glyphicon glyphicon-remove">
            	</span> Delete
			</a>
       <li role="presentation" class="divider">
		</li>           
	    <li role="presentation">
			<a  id="edit" onclick="return edit_mem()" href="index.php?action=edit&lib_id=<?php echo $result['lib_id'];?>">
				<span class="glyphicon glyphicon-edit">
				</span> Edit
			</a>
		</li>
	</ul> 
</div>
<?php
			echo"
						</td>						
						<td>";
						echo '<a title="'.$result['fname'].' '.$result['lname'].'" class="fancybox" href="source/images/members/'.$result['member_image'].'">';
						if(($result['member_image']!="") and file_exists("source/images/members/".$result['member_image'])){
							echo"<img id=\"member_image\" width=\"60\" height=\"80\" src=\"source/images/members/".$result['member_image']."\" />									";
						}else
						{							
							echo"<img id=\"member_image\" width=\"70\" height=\"70\" src=\"source/images/members/default.jpg\" />";							
							
						}
						echo '</a>';
						echo "<a id=\"link\" targer=\"_top\" title=\"View Details of $result[1]\"href=\"index.php?action=memberstatus&libid=$result[3]\">";
						echo "<br>".$result['fname']." ".$result['lname']."</a>";
						echo"
						</td>
						<td>
							".$result['lib_id']."
						</td>
						<td>							
							".$result['mobile_number']."
						</td>
						<td><a title=\"Send Email to $result[1]\"href=\"mailto:$result[5]?Subject=Message From Librarian\">
							".$result['email']."
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
			echo "<tr><td colspan=13><span style=\"color:green\">There are currently no members in the System !</span></td></tr></tbody>";
			echo "</table>";
			
		}			
	

?>