<div class="editmemberdetails_form">
<?php
					echo"
					<form name=\"add_member\" enctype=\"multipart/form-data\" method=\"POST\" action=\"index.php\">
						<table  align=\"center\"  border=\"1\">
							<tr>
								<th class=\"alert alert-info\" colspan=\"4\" style=\"text-align:center;\">
									 Edit Member Information :<font color=\"blue\">". $res['fname']." ".$res['lname']."</font>
								</th>							
							</tr>
							<tr>
								<th>
									First Name*
								</th>
								<td>
									<input class=\"form-control\" required autofocus type=\"text\" name=\"txtfname\" placeholder=\"First Name\" value=".$res['fname'].">
								</td>
							
								<th>
									Last Name*
								</th>
								<td>
									<input  class=\"form-control\" required autofocus  type=\"text\" name=\"txtlname\" placeholder=\"Last Name\" value=\"".$res['lname']."\">
								</td>
							</tr>
							<tr>
								<th>
									Library ID**
								</th>
								<td>
									<input  class=\"form-control\" required autofocus  readonly=\"readonly\" type=\"text\" name=\"txtlibid\" placeholder=\"ID\" id=\"libid\" value=".$res['lib_id'].">
								</td>
								<th>
									Mobile*
								</th>
								<td>
									<input  class=\"form-control\" required autofocus  type=\"text\" name=\"txtmobile\" placeholder=\"Mobile\"value=".$res['mobile_number'].">
							</td>
							</tr>
							<tr>
								<th>
									Email-Address*
								</th>
								<td>
									<input  class=\"form-control\" required autofocus  type=\"text\" name=\"txtemail\" placeholder=\"Email\"value=".$res['email'].">
								</td>
								<th>
									Password*
								</th>
								<td>
									<input id = \"tbPass\" class=\"form-control\" required autofocus  type=\"password\" name=\"txtpass\" placeholder=\"Password\" 
									value=\"".$res['password']."\">
							</tr>
							<tr>
								<th>
									Address-1*
								</th>
								<td>
									<input  class=\"form-control\" required autofocus  type=\"text\" name=\"txtadd1\" placeholder=\"Address-1\"value=\"".$res['temporary_address']."\">
								</td>							
								<th>
									Address-2
								</th>
								<td>
									<input  class=\"form-control\" type=\"text\" name=\"txtadd2\" placeholder=\"Address-2\"value=\"".$res['permanent_address']."\">
								</td>
							</tr>
							<tr>
								<th>
									Father
								</th>
								<td>
									<input  class=\"form-control\"  type=\"text\" name=\"txtfather\" placeholder=\"Father Name\" value=\"".$res['father_name']."\">
								</td>
								<th>
									Batch
								</th>
								<td>
									<input  class=\"form-control\"   type=\"text\" name=\"txtbatch\" placeholder=\"Enrolled Year\"value=".$res['batch'].">
								</td>
							</tr>
							<tr>
								<th>
									Category*
								</th>
								<td>
									<select  class=\"form-control\" required autofocus  name=\"category\">
										<option value=\"Student\">
										Student
									</option>
									<option value=\"Teacher\">
										Teacher
									</option>
									<option value=\"Staff\">
										Staff
									</option>
									<option value=\"Others\">
										Others
									</option>									
								</td>		
												
							<th>
								Department
							</th>
							<td>
								<select class=\"form-control\" required autofocus name=\"txtdepartment\">";							
									$query = mysql_query("select department from constants group by department desc");
								while($row = mysql_fetch_array($query)){
								echo'
									<option value="'.$row['department'].'">'.$row['department'];									
								}
								echo"							
							</td>	
							</tr>
							<tr>
								<th>
									Photo* .jpg | .png | .gif | .bmp
								</th>
								<td colspan=\"3\">
								<input type=\"file\" required autofocus name=\"uploadedimage\"\"/>
									
								</td>
							</tr>
							<tr>			
								<td colspan=\"4\">
									<input class=\"btn btn-warning\" type=\"submit\" name=\"update\" value=\"Update\">								
									<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\" onclick=\"return clearall(this)\">
								</td>
							</tr></table></form>";	 
	?>
    
	</div>
    