<br><br>
<center>Add a  New Department</center>
<?php
echo'<div class="addDpt">';
			echo"<form  role = \"form\" name=\"signup\" method=\"POST\" action=".site_url."/admin/actions.php>";
					echo "<table align=\"center\" border=\"2px\" bgcolor=\"white\">
						
						<tr>
							<th>
								Department
							</th>
							<td>
								<input type=\"text\" name=\"txtdepartment\"  class=\"form-control\" required autofocus placeholder=\"Department Name\"> </td>
						</tr>
						<tr>															
							<th>
								Books per Member
							</th>
							<td>
								<input type=\"number\" name=\"txtnumbooks\"  class=\"form-control\" required autofocus placeholder=\"Issuable Book Count\">
							</td>	
						</tr>
						<tr>						
							<td colspan = \"2\">
								<input class=\"btn btn-success\" type=\"submit\" name=\"adddepartment\" value=\"Create\">
								<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\">
							</td>
						</tr>";			
						
		echo '</div>';
?>

