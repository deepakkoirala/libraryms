<?php include site_url.'/includes/dependencies.php';
if(isset($_SESSION['go'])){
	echo "<script> window.location =\"".site_url."/admin/index.php?page=lostfine-manager&action=found&id=".$_SESSION['id']."\"; </script>";
}
function checkFine($id){
	$fine = mysql_fetch_array(mysql_query("SELECT action from lostbooks where id = '$id'"));
	if($fine['action'] =='Fined' or $fine['action'] != '')
		return true;
	else
		return false;
}
?>

<div class="listlostbooks">
	<span style="text-align:left"><font color="purple"><center>Data :: Lost and Fined Books</center></font></span>
    <center>
	<table border="1px" >
     <tr>
     	<td colspan="9">
		<font color="red"> <?php if(isset($_SESSION['msg'])){?><?php echo $_SESSION['msg'];unset($_SESSION['msg']);?><?php }?></font></td>
		<tr>
        	<th>
            	Count
            </th>			
			<th>
				 Title
			</th>			
			<th>
				Authors
			</th>
            <th>
				Member
			</th>     
            <th>
				Reported On
			</th>
             <th>
				Reporting Staff
			</th>  
            <th>
				Action Performed
			</th>             
            <th>
                <?php $totalfine = mysql_fetch_array(mysql_query('SELECT sum(fine_amount) from lostbooks'));?>
				<font color="yellow">Total Fine </font><br /><font color="black">Rs: <?php echo $totalfine['sum(fine_amount)']; ?></font>

                
			</th>             
            <th>
				Action
			</th>           
          </tr>
          
          <?php
			$sql = mysql_query("SELECT * from lostbooks order by date_reported");
			if(mysql_num_rows($sql)>0)
        	{
				$sn = 1;
		
				while($lostbook  = mysql_fetch_array($sql)){
				$flag = true;
		  ?>          
          <tr>
          	<td>
            	<?php echo $sn++;?>                
            </td>  
            <td>        	   
            	<?php 
					$book = mysql_fetch_array(mysql_query("SELECT * from books_info where accession_no = '".$lostbook['book']."'"));
					echo'<a class="fancybox" href="'.site_url.'/source/images/books/'.$book['cover'].'">
							<img width="60" height="70" src="'.site_url.'/source/images/books/'.$book['cover'].'"/	>
						</a><br>';
					echo '<a id="link" title="View all: '.$book['title'].'" href="'.site_url.'/index.php?action=bookstatus&an='.$book['accession_no'].'">'.$book['title'].'</a>';
				?>             
            </td>
            <td>   
            	<?php echo $book['authors'];?>             	
            </td>
            <td>          
            	<?php $member = mysql_fetch_array(mysql_query("SELECT * from members_info where lib_id = '".$lostbook['member']."'"));
				?>
                <a class="fancybox" href="<?php echo site_url;?>/source/images/members/<?php echo $member['member_image'];?>" >
                	<img width="60" height="70" src="<?php echo site_url;?>/source/images/members/<?php echo $member['member_image'];?>" />
                	
                </a>
                <a id="link" href="<?php echo site_url;?>/index.php?action=memberstatus&libid=<?php echo $member['lib_id'];?>">
                <br />
				<?php
echo '<a title="See all Transactions of '.$member['fname'].' '.$member['lname'].'" id="link" href="'.site_url.'/index.php?action=memberstatus&libid='.$member['lib_id'].'">'.$member['fname'].' '.$member['lname'].'</a>';
				?>        
                </a>
            </td>
             <td>
	           	<?php echo $lostbook['date_reported'];?>                      
            </td>            
            <td> 
	        <?php
				 $staff = mysql_fetch_array(mysql_query("SELECT * from staffs_info where email = '".$lostbook['staff']."'")); 
				 echo'<a id="link" title="View" href="'.site_url.'/index.php?action=staffdetails&email='.$lostbook['staff'].'">';
				 echo $staff['fname'].' '.$staff['lname'];
				 echo'</a>';
			?>  
            </td>
            <td>    
            	<?php if($lostbook['action']=="") echo "Pending"; else echo $lostbook['action'];?>        
            </td>                        
            <td>            
                 <?php if($lostbook['fine_amount']=="0") echo "-"; else echo 'Rs.'.$lostbook['fine_amount'];?>        
            </td>
            <td>
    <?php if(!checkFine($lostbook['id'])){?>
   <div class="dropdown">
  <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
   Action
   <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
     <li role="presentation">    
    <font color="black"><b>Action</b></font></li>
    <li role="presentation" class="divider"></li>	    
   <li id="dropdownText" role="presentation">
    	<a id="edit" role="menuitem" tabindex="-1"  href="<?php echo site_url;?>/admin/index.php?page=lostfine-manager&action=replace&id=<?php echo $lostbook['id']
		;?>">    		
		   1. Replace Book
    	</a>
   </li>
   <li id="dropdownText" role="presentation">
    	<a id="edit" role="menuitem" tabindex="-1"  href="<?php echo site_url;?>/admin/index.php?page=lostfine-manager&action=found&id=<?php echo $lostbook['id']
		;?>">    		
		   2. Book Found
    	</a>
   </li>
   <li role="presentation" class="divider"></li>	    
   <li id="dropdownText" role="presentation">
    	<a id="edit" role="menuitem" tabindex="-1"  href="<?php echo site_url;?>/admin/index.php?page=lostfine-manager&action=fine&id=<?php echo $lostbook['id']
		;?>">    		
		   3. Charge Fine
    	</a>
   </li>
   </ul>
   </div>
   <?php }else{   ?>
   			Action<?php }?>
          </td>             
          </tr>
         <?php }}else{
		 	echo '<tr><td colspan="9"><h4>Empty</h4></td></tr>';
		 }
		 ?>
       </table>       
</center></div>
