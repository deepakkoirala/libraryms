<div class="addmember_form">
<?php
include site_url.'/includes/constants.php';
include site_url.'/includes/database.php';

echo"<h3 align=\"center\" class=\"alert alert-info\"> Add a new Library Member</h3>";
			echo"
				<form name=\"add_member\" method=\"POST\" action=\"\"  enctype=\"multipart/form-data\" >
					<table width=\"900px\" align=\"center\" cellpadding=\"0px\" cellspacing=\"1px\" border=\"0\">
						
						<tr>						
							<td>
								FirstName*<input class=\"form-control\" required autofocus type=\"text\" name=\"txtfname\" placeholder=\"First Name\">
							</td>						
							
							<td>LastName*
								<input class=\"form-control\" required autofocus type=\"text\" name=\"txtlname\" placeholder=\"Last Name\">
							</td>
							<td>Library ID
								<input class=\"form-control\" required autofocus type=\"text\" name=\"txtlibid\" id=\"libid\" value=".generate_libid().">
							</td>	
						</tr>
						<tr>
							<td>Mobile*
								<input class=\"form-control\" required autofocus type=\"text\" name=\"txtmobile\" placeholder=\"Mobile\">
							</td>													
							<td>Email Address*
								<input class=\"form-control\" required autofocus type=\"text\" name=\"txtemail\" placeholder=\"Email\">
							</td>
							<td>Temporary Address*
								<input class=\"form-control\" required autofocus type=\"text\" name=\"txtadd1\" placeholder=\"Address-1\">
							</td>							
						</tr>
						<tr>
							<td>Permanent Address
								<input class=\"form-control\"  type=\"text\" name=\"txtadd2\" placeholder=\"Address-2\">
							</td>	
							<td>Father's Name
								<input class=\"form-control\"  type=\"text\" name=\"txtfather\" placeholder=\"Father Name\">
							</td>													
							<td>Enrolled Year
								<input class=\"form-control\"  type=\"number\" name=\"txtbatch\" placeholder=\"Enrolled Year\">
							</td>														
						</tr>						
						<tr>
						<td>Category*
								<select class=\"form-control\" required autofocus name=\"category\">									
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
							<td>Department*
								<select class=\"form-control\" required autofocus name=\"txtdepartment\">";
								
								$query = mysql_query("select department from constants group by department desc");
								if(mysql_num_rows($query)==0){
									echo '<option value="-1">System has no Departments Yet !</option>';
								}else{
								while($row = mysql_fetch_array($query)){
								echo'
									<option value="'.$row['department'].'">'.$row['department']."</option>";									
								}
								}
					echo"</td>													
						<td>Photo* .jpg | .png | .gif | .bmp
							 <input required autofocus type=\"file\" name=\"uploadedimage\">
						</td>					
						</tr>
						<tr>
							<td colspan=\"3\">
								<input class=\"btn btn-default\" type=\"submit\" name=\"addmem\" value=\"Add Member\">
								<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Reset\">
							</td>
						</tr>
						<tr>
							<th colspan=\"4\" class=\"alert alert-info\">
								Note: Default Password is the First Name of the Member
							</th>
						</tr>
					</table>
				</form>";
?>
</div>