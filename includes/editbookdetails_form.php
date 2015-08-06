<div class="editbookdetails_form">
<?php
			echo"<center><h2 class=\"alert alert-info\">Edit Details</h2></center>
				<form enctype=\"multipart/form-data\" name=\"add_member\" method=\"POST\" action=\"index.php\">
					<table align=\"center\" cellpadding=\"0px\" cellspacing=\"1px\" border=\"0\">						
						<tr>						
							<th>
								Accession Number**
							</th>
							<td>
								<input id=\"an\" class=\"form-control\" required autofocus type=\"text\" name=\"txtan\" placeholder=\"Accession Number\" value=\"".$res['accession_no']."\">
							</td>
							<th>
								Call Number*
							</th>
							<td>
								<input  id=\"callno\" class=\"form-control\" required autofocus type=\"text\" name=\"txtcallno\" placeholder=\"Call Number\"value=\"".$res['call_no']."\">
							</td>
						</tr>
						<tr>
							<th>
								Authors*
							</th>
							<td>
								<input id=\"authors\" class=\"form-control\" required autofocus type=\"text\" name=\"txtauthors\" placeholder=\"Authors Name\"value=\"".$res['authors']."\">
							</td>
							<th>
								Title*
							</th>
							<td>
								<input id=\"title\" class=\"form-control\" required autofocus type=\"text\" name=\"txttitle\" placeholder=\"Book Title\"value=\"".$res['title']."\">
							</td>
						</tr>
						<tr>
							<th>
								Publisher*
							</th>
							<td>
								<input id=\"p\"  class=\"form-control\" required autofocus type=\"text\" name=\"txtp\" placeholder=\"Publisher's Name\"value=\"".$res['publisher']."\">
							</td>
							<th>
								Published Date
							</th>
							<td>
								<input id=\"pd\" class=\"form-control\"  type=\"text\" name=\"txtpd\" placeholder=\"Date of Publication\" 
								id=\"datepicker\"value=\"".$res['published_date']."\">
							</td>
						</tr>
						<tr>
							<th>
								Published Place
							</th>
							<td>
								<input id=\"pp\"  class=\"form-control\"  class=\"form-control\" type=\"text\" name=\"txtpp\" placeholder=\"Place of Publication\"value=\"".$res['published_place']."\">
							</td>
							<th>
								Edition*
							</th>
							<td>
								<input id=\"edition\" class=\"form-control\" required autofocus class=\"form-control\" required autofocus type=\"text\" name=\"txtedition\" placeholder=\"Edition\"value=\"".$res['edition']."\">
							</td>
						</tr>
						<tr>
							<th>
								Price
							</th>
							<td>
								<input id=\"price\" class=\"form-control\" type=\"text\" name=\"txtprice\" placeholder=\"Price of Book\"value=\"".$res['price']."\">
							</td>
							<th>
								Pages
							</th>
							<td>
								<input id=\"pages\"  class=\"form-control\" type=\"text\" name=\"txtpage\" placeholder=\"Total Pages\"value=\"".$res['pages']."\">
							</td>
						</tr>						
						<tr>
							<th>
								Volume
							</th>
							<td>
								<input id=\"volume\" class=\"form-control\"   type=\"text\" name=\"txtvolume\" placeholder=\"Volume\"value=\"".$res['volume']."\">
							</td>
							<th>
								Source*
							</th>
							<td>
								<input id=\"source\" class=\"form-control\" required autofocus type=\"text\" name=\"txtsource\" placeholder=\"Source\" 
								value=\"".$res['source']."\">
							</td>
						</tr>
						<tr>
							<th>
								Bill Number
							</th>
							<td>
								<input id=\"billno\" class=\"form-control\" type=\"text\" name=\"txtbillno\" placeholder=\"Billnumber\"value=\"".$res['bill_no']."\">
							</td>
							<th>
								Subject*
							</th>
							<td>
								<input id=\"subject\" class=\"form-control\" required autofocus type=\"text\" name=\"txtsubject\" placeholder=\"Subject\"value=\"".$res['subject']."\">
							</td>
						</tr>
						<tr>
							<th>
								Category*
							</th>
							<td>
								<input id=\"category\" class=\"form-control\" required autofocus type=\"text\" name=\"txtcategory\" placeholder=\"Category of Book\"value=\"".$res['category']."\">
							</td>						
							<th>
								Type*
							</th>
							<td>								
								<select  class=\"form-control\" required autofocus name=\"txttype\">
									<option value=\"Book\">Regular Book</option>
									<option value=\"Reference\">Reference Book</option>
									<option value=\"Manual\">Manual</option>
									<option value=\"Journal\">Journal</option>
									<option value=\"Other\">Others</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>
								Remark
							</th>
							<td>
								<input type=\"text\" id=\"remark\"  class=\"form-control\" type=\"text\" name=\"txtremark\" placeholder=\"Remark on Book\" 
						value=\"".$res['remark']."\">
							</td>
							<td>
								Cover Image* .jpg | .png |.gif |.bmp
							</td>						
							<td>
								<input type=\"file\" required autofocus name=\"uploadedimage\"/>
							</td>
						</tr>
						<tr>
							<td colspan=\"4\">
								<input class=\"btn btn-warning\" type=\"submit\" name=\"updatebook\" value=\"Update Book\">							
								<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\">
							</td>
						</tr>";	 
?>
</div>