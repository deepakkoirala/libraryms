<?php	 
	include 'includes/dependencies.php';
	 include 'log.php';
	 $action = 'Gallery_Viewed';
	 $item = $_SESSION['email'];
	 $desc = 'Gallery Section Entered';
	 logSystem($action,$item,$desc);
 	 logAdmin($action,$item,$desc);
	 logStaff($action,$item,$desc);
	 
?>
<center>	
<div class="listStaffs">
<h3 class="alert alert-info">Members Photos</h3>
	<p>
    	<?php 
			$query = mysql_query("SELECT * from members_info");
			if(mysql_num_rows($query)!=0)
			{
				$i =1;
				while($photo = mysql_fetch_array($query))
				{
					$image = $photo['member_image'];					
					if(file_exists("../source/images/members/$image"))
					{
						echo $i.'.<a id="none" class="fancybox-thumbs" data-fancybox-group="thumb" href="'.site_url.'/source/images/members/'.$photo['member_image'].'">
						<img title="'.$photo['fname'].' '.$photo['lname'].'" width="60" height="80" src="'.site_url.'/source/images/members/'.$photo['member_image'].'" alt="" />
						</a>';
					$i++;
					}else
					{
						echo $i.'.<a id="none" class="fancybox-thumbs" data-fancybox-group="thumb" href="'.site_url.'/source/images/members/default.jpg">
						<img title="'.$photo['fname'].' '.$photo['lname'].'" width="60" height="80" src="'.site_url.'/source/images/members/default.jpg" alt="" />
					</a>';$i++;
					}
				}
			}else{
				echo "No Members Found !";
			}
		?>		
	</p>
    </div>
    <div>
    <h3 class="alert alert-info">Staffs Photos</h3>
	<p>
    	<?php 
			$query = mysql_query("SELECT fname,lname,staff_image from staffs_info");
			if(mysql_num_rows($query)!=0){
				$i = 1;
			while($photo = mysql_fetch_array($query)){
			if(file_exists("../source/images/staffs/".$photo['staff_image']."")){
			echo $i.'.<a id="none"  class="fancybox-thumbs" data-fancybox-group="thumb1" href="'.site_url.'/source/images/staffs/'.$photo['staff_image'].'">
						<img title="'.$photo['fname'].' '.$photo['lname'].'" width="60" height="80" src="'.site_url.'/source/images/staffs/'.$photo['staff_image'].'" alt="" />
					</a>';
					$i++;
			}else
			{
				echo $i.'.<a id="none" class="fancybox-thumbs" data-fancybox-group="thumb1" href="'.site_url.'/source/images/staffs/default.jpg">
					<img title="'.$photo['fname'].' '.$photo['lname'].'" width="60" height="80" src="'.site_url.'/source/images/staffs/default.jpg" alt="" />
					</a>';
					$i++;
			}
			}
			}else{
				echo "No Staffs Found !";
			}
		?>		
	</p>
    </div>
    <div>
    <h3 class="alert alert-info">Book Covers</h3>
    	<p>
    	<?php 
			$query = mysql_query("SELECT title,cover from books_info");
			if(mysql_num_rows($query)!=0){
				$i=1;
			while($photo = mysql_fetch_array($query)){
				
			if(file_exists("../source/images/books/".$photo['cover']."")){
			echo $i.'.<a id="none" class="fancybox-thumbs" data-fancybox-group="thumb2" href="'.site_url.'/source/images/books/'.$photo['cover'].'">
						<img title="'.$photo['title'].'" width="60" height="80" src="'.site_url.'/source/images/books/'.$photo['cover'].'" alt="" />
					</a>';
					$i++;
			}else
			{
				echo $i.'.<a id="none"  class="fancybox-thumbs" data-fancybox-group="thumb2" href="'.site_url.'/source/images/books/default.jpg">
						<img title="'.$photo['title'].'" width="60" height="80" src="'.site_url.'/source/images/books/default.jpg" alt="" />
					</a>';$i++;	
			}
			}
			}else{
				echo "No Books Found !";
			}
		?>		
	</p>
    </div>

</center>