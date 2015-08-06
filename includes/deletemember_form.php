<div class="deletemember_form">
<?php
echo"<h3 class=\"alert alert-info\" align=\"center\">Delete Member</h3>";

			echo"
				<form name=\"deletemember\" method=\"POST\" action=\"\" >
					<table align=\"center\" cellpadding=\"10px\" cellspacing=\"10px\" border=\"2\">						
						<tr>
							<th>
								Library ID
							</th>
							<td>
								<input id=\"issue_libid\" class=\"form-control\" required autofocus type=\"text\" name=\"txtlibid\" placeholder=\"Library ID of Member\">
							</td>
						</tr>						
						<tr>
							<td colspan=\"2\">
								<input class=\"btn btn-default\" type=\"submit\" name=\"deletemember\" value=\"Delete Member\" onClick=\"return del_mem()\">							
								<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\">
							</td>
						</tr>";	 
?>
</div>