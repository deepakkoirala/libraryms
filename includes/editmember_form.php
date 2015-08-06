<div class="editmember_form">
<?php
echo"<h3 class=\"alert alert-info\" align=\"center\">Member Info Update...</h3>";
			echo"
				<form name=\"editmember\" method=\"POST\" action=\"\" >
					<table align=\"center\" cellpadding=\"10px\" cellspacing=\"10px\" border=\"2\">						
						<tr>
							<td colspan=\"3\"?
								<h3 class=\"alert alert-info\">Select Member to Update Information...</h3>
							</td>
						</tr>
						<tr>
							<th>
								Library ID
							</th>
							<td>
								<input id=\"issue_libid\" class=\"form-control\" required autofocus type=\"text\" name=\"txtlibid\" placeholder=\"Library ID of Member\">
							</td>						
							<td>
								<input class=\"btn btn-default\" type=\"submit\" name=\"searchmember\" value=\"Search Member\">							
								<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\">
							</td>
						</tr>";			
?>
</div>