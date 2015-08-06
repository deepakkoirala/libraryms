<center>Add a  New Staff</center>
<?php
echo'<div class="signup_form">';
			echo"<form name=\"signup\" method=\"POST\" action=".site_url."/admin/actions.php>";
					echo "<table align=\"center\" border=\"2px\" bgcolor=\"white\">
						
						<tr>
							<th>
								First Name
							</th>
							<td>
								<input type=\"text\" name=\"fname\"  class=\"form-control\" required autofocus placeholder=\"First Name\">
							</td>						
							<th>
								Last Name
							</th>
							<td>
								<input type=\"text\" name=\"lname\"  class=\"form-control\" required autofocus placeholder=\"Last Name\">
							</td>	
						</tr>
						<tr>
							<th>
								Email Address
							</th>
							<td>
								<input type=\"email\" name=\"email\"  class=\"form-control\" required autofocus placeholder=\"Email\">
							</td>	
							<th>
								Phone Number
							</th>
							<td>
								<input type=\"number\" name=\"phone\"  class=\"form-control\" required autofocus placeholder=\"Mobile Number\">
							</td>
						</tr>
						<tr>
							<th>
								Password
							</th>
							<td>
								<input type=\"password\" name=\"password\"  class=\"form-control\" required autofocus placeholder=\"Password\">
							</td>	
							<th>
								Sex
							</th>						
							<td>
								<select name =\"sex\" class=\"form-control\" required autofocus >
									<option value =\"-1\" selected = \"selected\">Choose Gender</option>
									<option value =\"Male\">Male</option>
									<option value =\"Female\">Female</option>
									<option value =\"Other\">Other</option>
								</select>								
							</td>
						</tr>
						<tr>
							<th>
								Address 1
							</th>
							<td>
								<input type=\"text\" name=\"add1\"  class=\"form-control\" required autofocus placeholder=\"Temporary Address\">
							</td>						
							<th>
								Address 2
							</th>					
							<td>
								<input type=\"text\" name=\"add2\"  class=\"form-control\" required autofocus placeholder=\"Permanent Address\">
							</td>
						</tr>
						<tr>
							<th>
								Position
							</th>
							<td>
								<select  name=\"position\"  class=\"form-control\" required autofocus placeholder=\"Position\">
									<option value=\"Null\">Choose Position</option>
									<option value=\"Staff\">Book Keeper</option>
									<option value=\"Head\">Head Librarian</option>
									<option value=\"Admin\">Admin</option>									
									<option value=\"Others\">Other</option>
								</select>
							</td>	
							<td colspan = \"2\">
								<input class=\"btn btn-default\" type=\"submit\" name=\"addstaff\" value=\"Create User\">
								<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\">
							</td>
						</tr>";			
						
		echo '</div>';
?>

