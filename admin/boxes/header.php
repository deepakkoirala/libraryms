<div class="header">
     <a title="Back to Library" class="back_link btn btn-warning" href="<?php echo site_url;?>" >Go to Library</a>
     <div class="site_title"> <center><a id="none" href="<?php echo site_url;?>/admin">Library Administration Section</a></center></div>
     <div class="logout_link">
          	<?php 
				$email = $_SESSION['email'];			
				$data = mysql_fetch_array(mysql_query("SELECT * from staffs_info where email = '$email'"));			
			?>
     	<font color="yellow"> 
        	Logged as	
        </font>
        <a title="View Profile" id="edit" href="<?php echo site_url;?>/index.php?action=staffdetails&email=<?php echo $_SESSION['email'];?>" >
        	<?php echo $_SESSION['fname'].' '.$_SESSION['lname'];?>
        </a>
        <a title="Enlarge Image" class="fancybox" href="<?php echo site_url; ?>/source/images/staffs/<?php echo $data['staff_image']; ?>">
	        <img title="Photo" height="60" width="50" src="<?php echo site_url; ?>/source/images/staffs/<?php echo $data['staff_image']; ?>" />
        </a>
	    <a title="Logout" class=" btn btn-warning" href="logout.php" onclick="return logout()" >
        	Logout 
        </a>
      </div>

    
</div>
<div class="menu"> 
	<ul>
	   <li><a class = "btn btn-primary" href="<?php echo site_url;?>/admin/index.php?page=staff-manager">Library Staff Manager</a></li>       
	   <li><a class = "btn btn-primary" href="<?php echo site_url;?>/admin/index.php?page=lostfine-manager">Lost and Fine Manager</a></li>
       <li><a class = "btn btn-primary" href="<?php echo site_url;?>/admin/index.php?page=libcons-manager">Library Constant Manager</a></li>
       <li><a class = "btn btn-primary" href="<?php echo site_url;?>/admin/index.php?page=android-manager">Android Client Manager</a></li>
       <li><a class = "btn btn-primary" href="<?php echo site_url;?>/admin/index.php?page=gallery-manager">Gallery</a></li>
       <li><a class = "btn btn-primary" href="<?php echo site_url;?>/admin/index.php?page=core-manager">Core Settings</a></li>
     </ul> 
 </div>
 <div class="clear"></div>