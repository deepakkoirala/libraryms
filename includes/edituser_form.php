<?php
		include ('includes/login-check.php');
		include('includes/constants.php');
		include('includes/database.php');
		
	$email = $_SESSION['email'];
	$sql = mysql_query("SELECT * from staffs_info where email = '$email';");	
	$member = mysql_fetch_array($sql);
	$mem = "Librarian : <font color=\"blue\">".$member['fname']." ".$member['lname']. "</font>";
			
	?>	
<?php
$info = mysql_query("SELECT * from staffs_info where email = '$email';");	
$data = mysql_fetch_array($info);
echo'<div class="signup_form">';
echo"<h3 class=\"alert alert-info\" align=\"center\">Edit Your Profile <font color=\"purple\">". $data['fname']."! </font></h3>";
echo"<form name=\"signup\" method=\"POST\" action=\"index.php\">";
echo "<table align=\"center\" border=\"2px\" bgcolor=\"white\">
		<tr>
			<th>
				First Name
			</th>
			<td>
				<input type=\"text\" name=\"fname\"  class=\"form-control\" required autofocus placeholder=\"First Name\" value = ".$data['fname'].">
			</td>						
			<th>
				Last Name
			</th>
			<td>
				<input type=\"text\" name=\"lname\"  class=\"form-control\" required autofocus placeholder=\"Last Name\"value = ".$data['lname'].">
			</td>	
		</tr>
		<tr>
			<th>
				Email Address
			</th>
			<td>
				<input type=\"email\" name=\"email\"  class=\"form-control\" required autofocus placeholder=\"Email\" value = ".$data['email'].">
			</td>	
			<th>
				Phone Number
			</th>
			<td>
				<input type=\"number\" name=\"phone\"  class=\"form-control\" required autofocus placeholder=\"Mobile Number\" value = ".$data['phone'].">
			</td>
		</tr>
		<tr>
			<th>
				Password
			</th>
			<td>
				<input type=\"password\" name=\"password\"  class=\"form-control\" required autofocus placeholder=\"Password\" value = ".$data['password'].">
			</td>	
			<th>
				Sex
			</th>						
			<td>
				<select name =\"sex\" class=\"form-control\" required autofocus >
					<option value =\"NotChoosed\" selected = \"selected\">Choose Gender</option>
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
				<input type=\"text\" name=\"add1\"  class=\"form-control\" required autofocus placeholder=\"Temporary Address\" value = ".$data['temporary_address'].">
			</td>						
			<th>
				Address 2
			</th>					
			<td>
				<input type=\"text\" name=\"add2\"  class=\"form-control\" required autofocus placeholder=\"Permanent Address\" value = ".$data['permanent_address'].">
			</td>
		</tr>
		<tr>
			<th>
				Position
			</th>
			<td>
			<select  name=\"position\"  class=\"form-control\" required autofocus placeholder=\"Position\">
									<option value=\"NotChoosed\">Choose Position</option>
									<option value=\"Staff\">Book Keeper</option>
									<option value=\"Head Librarian\">Head Librarian</option>
									<option value=\"Admin\">Admin</option>									
									<option value=\"Others\">Other</option>
								</select>				
			</td>	
			<td colspan = \"2\">
				<input class=\"btn btn-default\" type=\"submit\" name=\"edituser\" value=\"Update Information\">
				<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\">
			</td>
		</tr>";			
		
		echo '</div>';
?>