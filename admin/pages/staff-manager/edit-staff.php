<?php
        $id = $_GET['user'];
        $user_query = "select * from staffs_info where email = '$id' ";
        $user_result = mysql_query($user_query) or die(mysql_error());
        $row = mysql_fetch_assoc($user_result);
?>

<center>Edit Staff Information</center>
<?php
echo'<div class="signup_form">';
			echo"<form name=\"signup\" method=\"POST\" action=".site_url."/admin/actions.php?user=".$id.">";
					echo "<table align=\"center\" border=\"2px\" bgcolor=\"white\">
						
						<tr>
							<th>
								First Name
							</th>
							<td>
								<input value=".$row['fname']." type=\"text\" name=\"fname\"  class=\"form-control\" required autofocus placeholder=\"First Name\">
							</td>						
							<th>
								Last Name
							</th>
							<td>
								<input value=".$row['lname']." type=\"text\" name=\"lname\"  class=\"form-control\" required autofocus placeholder=\"Last Name\">
							</td>	
						</tr>
						<tr>
							<th>
								Email Address
							</th>
							<td>
								<input value=".$row['email']." type=\"email\" name=\"email\"  class=\"form-control\" required autofocus placeholder=\"Email\">
							</td>	
							<th>
								Phone Number
							</th>
							<td>
								<input value=".$row['phone']." type=\"number\" name=\"phone\"  class=\"form-control\" required autofocus placeholder=\"Mobile Number\">
							</td>
						</tr>
						<tr>
							<th>
								Password
							</th>
							<td>
								<input value=".$row['password']." type=\"password\" name=\"password\"  class=\"form-control\" required autofocus placeholder=\"Password\">
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
								<input value=".$row['temporary_address']." type=\"text\" name=\"add1\"  class=\"form-control\" required autofocus placeholder=\"Temporary Address\">
							</td>						
							<th>
								Address 2
							</th>					
							<td>
								<input value=".$row['permanent_address']." type=\"text\" name=\"add2\"  class=\"form-control\" required autofocus placeholder=\"Permanent Address\">
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
									<option value=\"Head Librarian\">Head Librarian</option>
									<option value=\"Admin\">Admin</option>									
									<option value=\"Others\">Other</option>
								</select>
							</td>	
							<td colspan = \"2\">
								<input class=\"btn btn-default\" type=\"submit\" name=\"editstaff\" value=\"Update Information\">
								<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\">
							</td>
						</tr>";			
						
		echo '</div>';
?>

