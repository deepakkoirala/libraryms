<?php include 'includes/dependencies.php';?>

<center>
<div class="listConstants">

<table border="1px" align="center">

	<tr>
    	<td colspan="2">
        <font color="red">
		<?php
			 if(isset($_SESSION['msg']))
			 {
				 echo $_SESSION['msg'];
				 unset($_SESSION['msg']);				 
			  }else{
				  echo '<font color="brown">Books per Department</font>';
			  }
		?>
        </font>
       </td>       
       <td>
        	<a href="<?php echo site_url;?>/admin/index.php?page=libcons-manager&action=add" class="btn btn-warning">
            	<font color="white">
            		New Department
                </font>
            </a>
        </td>
	</tr> 
    <tr>
       <th>
           	Departments
        </th>    
		<th>
			Num Books Issuable
		</th>     				
		<th>        
				Modify
		</th>
     </tr>          
               <?php
			$sql = mysql_query("SELECT * from constants");
			if(mysql_num_rows($sql)>0)
        	{
				$sn = 1;
		
				while($cons = mysql_fetch_array($sql)){
					$flag = true;
		  ?>
          <tr>
                    	<th>
            	<?php echo $cons['department'];?>
            </th>
            <td>
            	<?php echo $cons['numbooks'];?>
            </td>
          	<td>
                        	<a id="edit" title="Click to Edit" onClick="return editDpt()" href="<?php echo site_url;?>/admin/index.php?page=libcons-manager&action=edit&id=<?php echo $cons['depid'];?>">
                            <span class="glyphicon glyphicon-edit"></span></a> | <a
                            id="edit" title="Click to Delete Department Permanently." onClick="return delDpt()" href="<?php echo site_url;?>/admin/index.php?page=libcons-manager&action=delete&id=<?php echo $cons['depid'];?>">
                            <span class="glyphicon glyphicon-remove"></span></a>
            </td> </tr>          
         <?php 
		 }
		 }else
		 {
		 	echo '<tr><td colspan="3"><h4>No Departments Added Yet</h4></td></tr>';
		 }
		 ?>
         </table></div></center>
