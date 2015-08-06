<?php
		echo '<center><font color = "purple">All Availaible Books</font></center>';
					echo"<table class=\"bookajax\" border=\"01px\"align=\"center\">";				
					echo"
						<tr>
							<th>
								SN
							</th>
							<th>
								Modify
							</th>							
							<th>
								Cover
							</th>
							<th>
								Authors
							</th>														
							<th>
								AN
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
						
			$findbook = mysql_query("SELECT * from books_info where title like '$string%' or accession_no like '$string' or call_no like '$string%' or authors like '$string%' or published_date like '$string%' or publisher like '$string%' or published_place like '$string%' or price like '$string%' or pages like '$string%' or bill_no like '$string%' or subject like '$string%' or category like '$string%' or type like '$string%' or remark like '$string%' or date_added like '$string%' having flag = 1 order by title"); 
			$j = 1;
			while($fb = mysql_fetch_array($findbook))
			 {
				
			 	echo"<tr>
						<td>"
							.$j."
						</td>				
						<td>
							<a title=\"Edit Details\" onclick=\"return edit_book()\" id=\"edit\" href=\"index.php?an=".$fb['accession_no']."&action=edit\">
								<span class=\"glyphicon glyphicon-edit\"><span>
							</a> | 
							<a title=\"Delete Book\"  onclick=\"return del_book()\" id=\"edit\" href=\"index.php?an=".$fb['accession_no']."&action=del\">
								<span class=\"glyphicon glyphicon-remove\"><span>
							</a>
						</td>												
						<td>";
					echo "<a class=\"fancybox\" href=\"source/images/books/".$fb['cover']."\">";
					if(($fb['cover']!="") and file_exists("source/images/books/".$fb['cover']))
					{
						echo"<img title=\"".$fb['title']."\" id=\"member_image\" width=\"80\" height=\"100\" src=\"source/images/books/".$fb['cover']."\" />";
					}else
					{							
						echo"<img title=\"".$fb['title']."\" id=\"member_image\" width=\"80\" height=\"100\" src=\"source/images/books/default.jpg\" />";							
					}
					echo"</a>";
					echo "<a title=\"View All ".$fb['title']."\"  href=\"index.php?action=bookstatus&an=".$fb['accession_no']."\">";
						echo "<br>".$fb['title'];
					echo"</a></td>
					<td>
							".$fb['authors']."
					</td>
					<td>
							<a id=\"edit\" class=\"btn btn-success\" target=\"_top\" href=\"index.php?action=issue&AccessionNumber=".$fb['accession_no']."\" title=\"Click to Issue\" id=\"bookdetails\">
							Issue
						</a>
						</td>";
					for($i = 0 ;$i <13;$i++)
					{
						echo "<td>".$fb[$i+5]."</td>";
					}
					$j++;
					
			 }
							
		if(mysql_num_rows($findbook) == 0)
		{
			echo "<tr><td colspan=19 align=\"center\"><span style=\"color:green;\">There are currently no books in the Library !</span></td></tr>";
			echo "</table>";
			
		}		
?>