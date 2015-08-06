<div class="issue">
<?php

$an = mysql_real_escape_string($_Request['an']);
echo"<h1 class=\"alert alert-info\"align=\"center\">Issue Book</h1>";

			echo"
				<form name=\"issue\" class=\"form-signin\" method=\"POST\" action=\"index.php\" enctype=\"multipart/form-data\" >
					<table align=\"center\" cellpadding=\"0px\" cellspacing=\"0px\" border=\"0px\">
						<tr>
							<th>
								Book
							</th>
							<td>
								<input id = \"issue_an\"  value =\"$AccessionNumber\"class=\"form-control\" type=\"text\" name=\"txtan\" placeholder=\"Which Book\" required autofocus>
							</td>
						</tr>
						<tr>
							<th>
								Member
							</th>
							<td>
								<input id = \"issue_libid\" class=\"form-control\" type=\"text\" name=\"txtlibid\" placeholder=\"Who is Issuing\" required autofocus>
							</td>
						</tr>
						<tr>
							<th>
								Due Date
							</th>
							<td>
								<input class=\"form-control\"  type=\"text\" name=\"txtduedate\" id=\"dp_issue\" placeholder=\"When to Return \" required autofocus>
							</td>
						</tr>
						<tr>							
							<td colspan=\"3\">
								<input class=\"btn btn-default\" type=\"submit\" name=\"issue\" value=\"Issue Book\">
								<input class=\"btn btn-default\"  align=\"center\"type=\"reset\" name=\"reset\" value=\"Clear\">
							</td>
						</tr>";	
?>
</div>