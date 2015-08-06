<div class="deletebook_form">
<?php
		echo"<h1 class=\"alert alert-info\"align=\"center\">Delete Book</h1>";
		echo"
				<form name=\"deletebook\" method=\"POST\" action=\"\" >
					<table align=\"center\" cellpadding=\"10px\" cellspacing=\"10px\" border=\"2\">						
						<tr>
							<th>
								Accession Number
							</th>
							<td>
								<input id=\"issue_an\" class=\"form-control\" required autofocus type=\"text\" name=\"txtan\" placeholder=\"Accession Number of Book\">
							</td>
						</tr>						
						<tr>
							<td>
								<input class=\"btn btn-default\" type=\"submit\" name=\"deletebook\" value=\"Delete Book\" onClick=\"return del_book()\">
							</th>
							<td>
								<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\">
							</td>
						</tr>";	
 ?>
 </div>