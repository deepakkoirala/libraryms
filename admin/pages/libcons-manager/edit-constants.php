<?php
        $id = $_GET['id'];
        $query = "select * from constants where depid = '$id' ";
        $result = mysql_query($query) or die(mysql_error());
        $row = mysql_fetch_assoc($result);
        ?>

<div class="add_manager">
  <br><br> <h3 class="manager_sub_title">Edit Department</h3>
<?php
echo'<div class="">';
			echo"<form  role = \"form\" name=\"signup\" method=\"POST\" action=".site_url."/admin/actions.php?depid=".$id.">";
					echo "<table align=\"center\" border=\"2px\" bgcolor=\"white\">
						
						<tr>
							<th>
								Department
							</th>
							<td>
								<input value=".$row['department']." type=\"text\" name=\"txtdepartment\"  class=\"form-control\" required autofocus placeholder=\"Department Name\"> </td>
						</tr>
						<tr>															
							<th>
								Books per Member
							</th>
							<td>
								<input value=".$row['numbooks']." type=\"number\" name=\"txtnumbooks\"  class=\"form-control\" required autofocus placeholder=\"Issuable Book Count\">
							</td>	
						</tr>
						<tr>						
							<td colspan = \"2\">
								<input class=\"btn btn-default\" type=\"submit\" name=\"editdepartment\" value=\"Update\">
								<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\">
							</td>
						</tr>";			
						
		echo '</div>';
?>
</div>