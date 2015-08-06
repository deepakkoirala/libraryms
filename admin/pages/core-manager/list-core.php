<script>
	function confirmFlush()
	{
		var c = confirm("Confirm Perform Operation? This cannot be reverted Back !");
		if(c==true)return true;
		else return false;
	}
</script>
<?php include 'includes/dependencies.php';

			$action = "Entered_Core";
			$item = $_SESSION['email'];
			$desc = "Entered into Core Setting Managers";
			logSystem($action,$item,$desc);
			logStaff($action,$item,$desc);
			logAdmin($action,$item,$desc);
?>

<center>
<div class = "listcore">

<table border="1px" align="center">
	<tr>
    	<td colspan="4">        
        <font color="red">
        <span id="msg">
		<?php
			 if(isset($_SESSION['msg']))
			 {
				 echo $_SESSION['msg'];
				 unset($_SESSION['msg']);				 
				 echo ' </font>';
			  }else{
				  echo '<font color="brown"> Flush all the Data in Here </font>';
			  }
		?>     
	  </span>  
       </td>             
	</tr> 
    <tr>
    	<th>SN</th>
       <th>
           	Library Entities
        </th>    
        <th>
			Meta
		</th>
		<th>
			Action
		</th>		
     </tr>   
     <tr><th>1</th>
     <th>Members</th>
     <td><?php echo mysql_num_rows(mysql_query("SELECT * from members_info")).' Members';?></td>
     <td>
     <a onclick="return confirmFlush()" href="index.php?page=core-manager&action=flushmem"  class="btn btn-success" id = "flushmem">Flush Data</a>

     </td>
     </tr>
     <tr>
          <tr><th>2</th>
     <th>Books</th>
     <td><?php echo mysql_num_rows(mysql_query("SELECT * from books_info")).' Books';?></td>
     <td>
     <a onclick="return confirmFlush()" href="index.php?page=core-manager&action=flushbooks"  class="btn btn-success" id = "flushbooks">Flush Data</a>
     
     </td>
     </tr>
     <tr>
          <tr><th>3</th>
     <th>Staffs</th>
     <td><?php echo mysql_num_rows(mysql_query("SELECT * from staffs_info")).' Staffs';?></td>
     <td><a onclick="return confirmFlush()" href="index.php?page=core-manager&action=flushstaffs" class="btn btn-success" id = "flushstaffs">Flush Data</a></td>
     </tr>      
     <tr>
          <tr><th>4</th>
     <th>Issues</th>
     <td><?php echo mysql_num_rows(mysql_query("SELECT * from issued")).' Issues';?></td>
     <td><a onclick="return confirmFlush()" href="index.php?page=core-manager&action=flushissues" class="btn btn-success" id = "flushissues">Flush Data</a></td>
     </tr>
     <tr>
          <tr><th>5</th>
     <th>Lost Books</th>
     <td><?php echo mysql_num_rows(mysql_query("SELECT * from lostbooks")).' Lost Books';?></td>
     <td><a onclick="return confirmFlush()" href="index.php?page=core-manager&action=flushlost"  class="btn btn-success" id = "flushlostbooks">Flush Data</a></td>
     </tr>
     <tr>
          <tr><th>6</th>
     <th>Departments</th>
     <td><?php echo mysql_num_rows(mysql_query("SELECT * from constants")).' Departments';?></td>
     <td><a onclick="return confirmFlush()" href="index.php?page=core-manager&action=flushdpt"  class="btn btn-success" id = "flushdepartments">Flush Data</a></td>
     </tr>
     <tr>
     <tr>
     <th>7</th>
     <th>Logs</th>
     <td><?php echo mysql_num_rows(mysql_query("SELECT * from logs")).' Records';?></td>
     <td>
     <a onclick="return confirmFlush()" href="index.php?page=core-manager&action=flushlogs" class="btn btn-success" id = "flushlogs">Flush Data</a></td>
     </tr>
     <tr>
     <th>8</th>
     <th>Wishlists</th>
     <td><?php echo mysql_num_rows(mysql_query("SELECT * from wishlists_info")).' Requests';?></td>
     <td><a onclick="return confirmFlush()" href="index.php?page=core-manager&action=flushwishlists"  class="btn btn-success" id = "flushwishlists">Flush Data</a></td>
     </tr>
     <tr><td colspan="4"><font color="red"><marquee behavior="slide">*Note:All Actions are Irreversible. Please Make Sure to have a Backup. </marquee></font></td></tr>
    </table>
		 
  </div></center>
