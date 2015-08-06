<?php include 'includes/dependencies.php';?>
<center>
<div class="listStaffs">
	<center><font color="purple">Library Staffs</font></center>	
	<table border="1px" >
     <tr><td colspan="9"><font color="red"><?php if(isset($_SESSION['msg'])){?><?php echo $_SESSION['msg'];unset($_SESSION['msg']);?><?php }?></font></td><td><a href="<?php echo site_url;?>/admin/index.php?page=staff-manager&action=add" class="btn btn-warning"><font color="white">New Staff</font></a></td></tr>
		<tr>
        	<th>
            	SN
            </th>
			<th>
				Modify
			</th>
			<th>
				Staff
            </th>
			<th>
				Email Address
			</th>
			<th>
				Phone
			</th>
			<th>
				Sex
			</th>
			<th>
				Temporary Address
			</th>
			<th>
				Permanent Address
			</th>
			<th>
				Postiton
			</th>
			<th>
				Date Joined
			</th>            
          </tr>
          
          <?php
			$sql = mysql_query("SELECT * from staffs_info");
			if(mysql_num_rows($sql)>0)
        	{
				$sn = 1;
		
				while($staffs = mysql_fetch_array($sql)){
					$flag = true;
		  ?>
          <tr>
          	<td>
            	<?php echo $sn++;?>
            </td>
          	<td>
            	<a  id="edit" title="Click to Edit Details" onClick="return edit_staff()" href="<?php echo site_url;?>/admin/index.php?page=staff-manager&action=edit&user=<?php echo $staffs['email'];?>">
                	<span class="glyphicon glyphicon-edit"></span>
                </a> <?php 
				if($_SESSION['email'] != $staffs['email'])
				{
					?>
	                 | <a  id="edit" title="Click to Delete Staff Permanently." onClick="return del_staff()" href="<?php echo site_url;?>/admin/index.php?page=staff-manager&action=del&user=<?php echo $staffs['email'];?>">
                    <span class="glyphicon glyphicon-remove"></span>
    	            </a><?php 
				}?>
            </td>     
            <td>            
            	<?php 				
				$photo = $staffs['staff_image'];				
				 ?>
                 <a class="fancybox" href="<?php echo site_url;?>/source/images/staffs/<?php echo $photo;?>">
	                 <img height="70" width="60" src="<?php echo site_url;?>/source/images/staffs/<?php echo $photo;?>" /><br />
                 </a>
                 <a id="link" href="<?php echo site_url;?>/index.php?action=staffdetails&email=<?php echo $staffs['email'];?>">
    	        	<?php echo $staffs['fname']." ".$staffs['lname'];?>
                </a>
            </td>
            <td>
            	<a href="mailto:<?php echo $staffs['email'];?>?subject=Message from WHIST Library"><font color="blue"><?php echo $staffs['email'];?></font></a>
            </td>
            <td>
            	<?php echo $staffs['phone'];?>
            </td>
            <td>
            	<?php echo $staffs['sex'];?>
            </td><td>
            	<?php echo $staffs['temporary_address'];?>
            </td><td>
            	<?php echo $staffs['permanent_address'];?>
            </td><td>
            	<?php echo $staffs['position'];?>
            </td><td>
            	<?php echo $staffs['date_joined'];?>
            </td>
          </tr>
         <?php }}else{
		 	echo '<tr><td colspan="9"><h4>No Users Added Yet</h4></td></tr>';
		 }
		 ?>
       </table>  
      </div></center>