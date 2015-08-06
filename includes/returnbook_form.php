<div class="returnbook_form">
<?php
echo"<h1 class=\"alert alert-info\"align=\"center\">Return Book</h1>";
		
			echo"
				<form name=\"issue\" class=\"return\"method=\"POST\" action=\"index.php\"  enctype=\"multipart/form-data\" >
					
					<table align=\"center\" cellpadding=\"10px\" cellspacing=\"10px\" border=\"0px\">
						<tr>
							<th>
								Accession Number
							</th>
							<td>
								<input id =\"return_an\"  class=\"form-control\"type=\"text\" name=\"txtan\" placeholder=\"Accession Number\" required autofocus>
							</td>
						</tr>											
						<tr>							
							<td colspan=\"2\">
								<input class=\"btn btn-default\"type=\"submit\" name=\"return\" value=\"Return\">
								<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\">
							</td>
						</tr>";			
?>
</div>