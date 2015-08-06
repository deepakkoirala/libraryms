<?php
echo'<div class="editbookinfo">';

echo"<h3 class=\"alert alert-info\" align=\"center\">Book Info Update...</h3>";
			echo"<form name=\"editbook\" method=\"POST\" action=\"\">";
					echo "<table align=\"center\" border=\"2px\" bgcolor=\"white\">
					<tr>
							<td colspan=\"3\"?
								<h3 class=\"alert alert-info\">Select Book to Update Information...</h3>
							</td>
						</tr>
						
						<tr>
							<th>
								Accession Number
							</th>
							<td>
								<input id=\"issue_an\" type=\"text\" name=\"txtan\"  class=\"form-control\" required autofocus placeholder=\"Accession Number\">
							</td>						
							<td>
								<input class=\"btn btn-default\" type=\"submit\" name=\"searchbooks\" value=\"Search Book\">
								<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\">
							</td>
						</tr>";							
echo '</div>';
?>
						