<?php include 'includes/dependencies.php';?>

<div class="listwishlists">
	<center><font color="purple">Data :: Member Requests for Unavailable Books</font></center>
    <center>
	<table border="1px" >
     <tr><td colspan="9">
		<font color="red"> <?php if(isset($_SESSION['msg'])){?><?php echo $_SESSION['msg'];unset($_SESSION['msg']);?><?php }?></font></td>
		<tr>
        	<th>
            	Count
            </th>			
			<th>
				Member			
			</th>
			<th>
				Email
			</th>
			<th>
				Book Title
			</th>			
			<th>
				Book Authors
			</th>     
            <th>
				Description
			</th>
             <th>
				Added
			</th>  
            <th>
				User Option(Notify)
			</th>             
            <th>
				Notification
			</th>               
          </tr>
          
          <?php
			$sql = mysql_query("SELECT * from wishlists_info order by date_created");
			if(mysql_num_rows($sql)>0)
        	{
				$sn = 1;
		
				while($wishlist = mysql_fetch_array($sql)){
					$flag = true;
		  ?>
          <tr>
          	<td>
            	<?php echo $sn++;?>                
            </td>          	   
            <td>
				<?php
				$email = $wishlist['email'];
				$member = mysql_fetch_array(mysql_query("Select fname,lname,lib_id,member_image from members_info where email='$email'"));
				?>
				<a title="<?php	echo $member['fname'].' '.$member['lname'];?>" class="fancybox" href="<?php echo site_url;?>/source/images/members/<?php echo $member['member_image'];?>">                
					<img width="60" height="60" src="<?php echo site_url;?>/source/images/members/<?php echo $member['member_image'];?>"/><br>
                </a>
                <a id="link" href="<?php echo site_url; ?>/index.php?action=memberstatus&libid=<?php echo $member['lib_id'];?>" title="View <?php echo $member['fname'];?>'s Issues">
				<?php	echo $member['fname'].' '.$member['lname'];?>
				</a>				
            </td>
            <td>
            	<a title="Send mail to <?php echo $member['fname'];?>" class="btn btn-success" id="link" href="mailto:<?php echo $wishlist['email'];?>?subject=Message from Library Admin">Email</a>
            </td>
            <td>
            	<?php echo $wishlist['title'];?>
            </td>
             <td>
            	<?php echo $wishlist['authors'];?>
            </td>
            <td>
            	<?php echo $wishlist['description'];?>
            </td>
            <td>
            	<?php echo $wishlist['date_created'];?>
            </td>
            <td>
            	<?php 
				if($wishlist['notify_flag']==true){echo "<span class=\"glyphicon glyphicon-ok-sign\"></span>";}else{echo "<span class=\"glyphicon glyphicon-remove\"></span>";}?>
            </td>
            <td>
  <?php  if($wishlist['notify_flag']==true){?>
   <div class="dropdown">
  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
  <?php  if(NotifiedStatus($wishlist['id'])){?>
   Re-Notify
  <?php } else { ?>
   Notify
   <?php } ?>
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
      <?php  if($wishlist['notify_flag']==true){?>
    <li role="presentation">    
    <font color="black"><b>Push Notification</b></font></li>
    <li role="presentation" class="divider"></li>	
    <li id="dropdownText" role="presentation">
    	<a id="edit" role="menuitem" tabindex="-1"  href="<?php echo site_url;?>/admin/index.php?page=android-manager&action=notify&id=<?php echo $wishlist['id']
		;?>">    		
		    Send Arrived
    	</a>
    </li> 
    <?php  if(NotifiedStatus($wishlist['id'])){?>
    <li id="dropdownText" role="presentation">
    	<a id="edit" role="menuitem" tabindex="-1"  href="<?php echo site_url;?>/admin/index.php?page=android-manager&action=cancel&id=<?php echo $wishlist['id']
		;?>">    		
		    Cancel Notification
    	</a>
    </li>    
     <?php } ?>
    <li role="presentation" class="divider"></li>
        <?php }?>
    <li id="dropdownText" role="presentation">
	    <a id="edit" onclick="return delWishlist()" role="menuitem" tabindex="-1" href="<?php echo site_url;?>/admin/index.php?page=android-manager&action=del&id=<?php echo $wishlist['id']
		;?>">Delete
       </a>
    </li>
  </ul>
</div>
  <?php } else { ?>
  <a class="btn btn-success" href="<?php echo site_url;?>/admin/index.php?page=android-manager&action=del&id=<?php echo $wishlist['id'];?>">
  	Delete
  </a>				
  	
  <?php }?>

            </td>             
          </tr>
         <?php }}else{
		 	echo '<tr><td colspan="9"><h4>No Requests Submitted Yet from any Members</h4></td></tr>';
		 }
		 ?>
       </table>       
</center></div>
<?php
	function NotifiedStatus($id){
		$check = mysql_fetch_array(mysql_query("SELECT availability from wishlists_info where id = $id"));
		if($check['availability'] == 1)
			return true;
		else
			return false;
	}	
?>

