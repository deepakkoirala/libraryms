<center>Add a new Book</center>
<?php
echo '<div class = "addbook_form"><br>';	
echo"
		<form name=\"add_member\" method=\"POST\"  enctype=\"multipart/form-data\" action=\"\">
			<table align=\"center\" cellpadding=\"0px\" cellspacing=\"0px\" border=\"0px\">						
				</tr>
				<tr>
					<th>
						Accession Number**
					</th>
					<td>					
						<input onkeyup=\"loadJSON()\" id=\"an\" class=\"form-control\" required id=\"libid\" type=\"text\" name=\"txtan\" value=".generate_randan().">								
					</td>					
					<th>
						Call Number*
					</th>
					<td>
						<input id=\"callno\" class=\"form-control\" required autofocus  type=\"text\" name=\"txtcallno\" placeholder=\"Call Number\">
					</td>
				</tr>
				<tr>
					<th>
						Authors*
					</th>
					<td>
						<input id=\"authors\" class=\"form-control\" required autofocus  type=\"text\" name=\"txtauthors\" placeholder=\"Authors Name\">
					</td>						
					<th>
						Title*
					</th>
					<td>
						<input id =\"title\" class=\"form-control\" required autofocus  type=\"text\" name=\"txttitle\" placeholder=\"Book Title\">
					</td>
				</tr>
				<tr>
					<th>
						Publisher*
					</th>
					<td>
						<input id =\"p\" class=\"form-control\" required autofocus  type=\"text\" name=\"txtpublisher\" placeholder=\"Publisher's Name\">
					</td>						
					<th>
						Published Date
					</th>
					<td>
						<input id =\"pd\" class=\"form-control\"  type=\"text\" name=\"txtpublisheddate\" placeholder=\"Date of Publication\" id=\"datepicker\">
					</td>
				</tr>
				<tr>
					<th>
						Published Place
					</th>
					<td>
						<input id =\"pp\" class=\"form-control\"   type=\"text\" name=\"txtpublishedplace\" placeholder=\"Place of Publication\">
					</td>						
					<th>
						Edition*
					</th>
					<td>
						<input id =\"edition\" class=\"form-control\" required autofocus  type=\"text\" name=\"txtedition\" placeholder=\"Edition\">
					</td>
				</tr>
				<tr>
					<th>
						Price
					</th>
					<td>
						<input id =\"price\" class=\"form-control\"   type=\"text\" name=\"txtprice\" placeholder=\"Price of Book\">
					</td>						
					<th>
						Pages
					</th>
					<td>
						<input id =\"pages\" class=\"form-control\"   type=\"text\" name=\"txtpages\" placeholder=\"Total Pages\">
					</td>
				</tr>						
				<tr>
					<th>
						Volume
					</th>
					<td>
						<input id =\"volume\" class=\"form-control\"  type=\"text\" name=\"txtvolume\" placeholder=\"Volume\">
					</td>						
					<th>
						Source*
					</th>
					<td>
						<input id =\"source\" class=\"form-control\" required autofocus  type=\"text\" name=\"txtsource\" placeholder=\"Source\">
					</td>
				</tr>
				<tr>
					<th>
						Bill Number
					</th>
					<td>
						<input id =\"billno\" class=\"form-control\" type=\"text\" name=\"txtbillno\" placeholder=\"Bill Number\">
					</td>						
					<th>
						Subject*
					</th>
					<td>
						<input id =\"subject\" class=\"form-control\" required autofocus  type=\"text\" name=\"txtsubject\" placeholder=\"Subject\">
					</td>
				</tr>
				<tr>
					<th>
						Category*
					</th>
					<td>
						<input id =\"category\" class=\"form-control\" required autofocus  type=\"text\" name=\"txtcategory\" placeholder=\"Category of Book\">
					</td>						
					<th>
						Type*
					</th>
					<td>
						<select class=\"form-control\" required autofocus  name=\"txttype\">
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
						<textarea id =\"remark\" rows=\"2\" cols=\"2\" class=\"form-control\"  autofocus  type=\"text\" name=\"txtremark\" placeholder=\"Remark onBook\"></textarea>
					</td>
				
					<th>
						Count*
					</th>
					<td>
						<input class=\"form-control\" required autofocus  type=\"number\" name=\"txtcount\" placeholder=\"Number of Book\">
					</td>
				</tr>
				<tr>
					<td>
						Cover Image* .jpg | .png |.gif |.bmp
					</td>						
					<td>
						<input type=\"file\" required autofocus name=\"uploadedimage\"/>
					</td>
					<td colspan=\"2\">
						<input class=\"btn btn-default\" type=\"submit\" name=\"addbook\" value=\"Add Book\">
						<input class=\"btn btn-info\" type=\"reset\" name=\"reset\" value=\"Clear\">
					</td>
				</tr>
			</table>
		</form>";		
 ?>
 </div>