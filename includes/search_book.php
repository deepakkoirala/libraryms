<?php
function checkIssued($an)
{
	$check = mysql_query("SELECT * from issued where accession_no = $an");
	if(mysql_num_rows($check)>0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

echo"<table  class=\"bookajax\" border=\"1px\"align=\"center\">";				
					echo"
						<tr>
							<th>
								SN
							</th>
							<th>
								Modify
							</th>
							
							<th>
								AN
							</th>
							<th>
								Book Code
							</th>
							<th>
								Authors
							</th>
							<th>
								Title
							</th>
							<th>
								Publisher
							</th>
							<th>
								Date Published
							</th>
							<th>
								Place Published
							</th>
							<th>
								Edition
							</th>
							<th>
								Price
							</th>
							<th>
								Pages
							</th>
							<th>
								Volume
							</th>
							<th>
								Source
							</th>
							<th>
								Bill No
							</th>
							<th>
								Subject
							</th>
							<th>
								Category
							</th>
							<th>
								Type
							</th>
							<th>
								Remark
 							</th>
						</tr>";
						
			$findbook = mysql_query("SELECT * from books_info where status like '$string%' or title like '$string%' or accession_no like '$string' or call_no like '$string%' or authors like '$string%' or published_date like '$string%' or publisher like '$string%' or published_place like '$string%' or price like '$string%' or pages like '$string%' or bill_no like '$string%' or subject like '$string%' or category like '$string%' or type like '$string%' or remark like '$string%' or date_added like '$string%'  order by title"); 
			$j = 1;
			while($fb = mysql_fetch_array($findbook))
			 {	
			 		echo'<tr>
							<td>'
								.$j.
							'</td>
							<td>';
							if(!($fb['status'] == 'lost')){
								echo'<a onclick="return edit_book()" title="Edit '.$fb['title'].' Info" id="edit" 
								href="index.php?an='.$fb['accession_no'].'&action=edit">
									<span class="glyphicon glyphicon-edit"></span>
								</a>';
							}else{
								echo '<font color="red">Book is Reported Lost</font>';
								}
							if(!checkIssued($fb['accession_no'])){
							echo'
								| <a title="Remove Book" id="edit" onclick="return del_book()" href="index.php?an='.$fb['accession_no'].
								'&action=del">
									 <span class="glyphicon glyphicon-remove"></span>
								</a>';
							} echo '
							</td>';				 	
					for($i = 0; $i < 17 ; $i++)
					{						
						echo"<td>";
						if($i==3)
						{
							
							echo "<a target=\"_top\" href=\"index.php?action=bookstatus&an=".$fb['accession_no']."\" title=\"Click to View All $fb[4] Book Details\" id=\"bookdetails\">";						
							
						}
						
						if($i==0)
						if(!(checkIssued($fb['accession_no']))){
						{
							echo "<a target=\"_top\" href=\"index.php?action=issue&AccessionNumber=".$fb['accession_no'	]."\" title=\"Click to Issue\" id=\"bookdetails\">";							
						}}
						echo $fb[$i+1];
						echo "</td>";								
					}
					echo "</tr>";
					$j++;
					
			 }
							
		if(mysql_num_rows($findbook) == 0)
		{
			echo "<tr><td colspan=19 align=\"center\"><span style=\"color:white;\">No Such Book Exists !</span></td></tr>";
			echo "</table>";
			
		}
?>