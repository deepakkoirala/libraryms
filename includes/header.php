    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
    <head>	
    <title>Library :: Home</title>  	       	            
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<?php	
		error_reporting(0);		
		include 'includes/dependencies.php';	
		include 'main.php';	
		date_default_timezone_set("Asia/Kolkata"); 
	?>    
     </head>
 <body> 	<div class="header">
		<a href=" <?php echo site_url;?>">
        	<div class="logo" >
				<img src="source/images/logo1.gif" alt="Logo" title="Logo" align="left" >         
			</div>
        </a>  <!--  end of logo -->
		<div id="libraryStatus">
        	<ul type="circle">            
            <span style="margin-left:25px;">
					<a  id="edit" href="index.php?action=refreshLibrary" title="Refresh Data">
		            <b><font face="Courier New" color="yellow"><u>Statistics</u></font> </b></a><br> 
            </span>
            	<li><font color="white">
                	Members:&nbsp;<?php echo totalMembers(); ?>
                    &nbsp;&nbsp;&nbsp;Books:&nbsp;<?php echo totalBooks(); ?><br></font>
                </li>
                <li>
					<a id="edit" href="index.php?action=viewAllIssues" title="View all Issued Books">
                    <font color="white">
        		   Issues&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?php echo totalIssues(); ?></font> </a>
                    &nbsp;
                    <a id="edit" target="_new" href="<?php echo site_url;?>/admin/index.php?page=lostfine-manager" title="View all Lost Books">
        		   <font color="white"> &nbsp;Lost&nbsp;&nbsp;:&nbsp;<?php echo totalLost(); ?></font></a>
                </li>
           </ul>
		</div>	 <!--  end of libraryStatus div -->	
	    <div class="title">
    		<?php
				$email = $_SESSION['email'];
    			if(checkAdmin())
				{
    				echo 'Admin Section <br>';				
					echo '<center><a title = "Enter Admin Section" class="btn btn-info" href = "admin/" target="_new"> Click Here to Enter the Management Section </center></a>';				
					
    			}
    			else
    			{
					if(isset($_SESSION['fname']))
					{
						echo "<h1>Library Panel</h1>";
					}
					else
					{
						echo "<h1>Library Management System</h1>";
					}
				} 						
			?>
	     </div> <!--  end of title -->	        	
       	 <div id="dateTime" class="dateTime">                    
    	 </div><!--  end of dateTime -->	        	                
	     <div class="user">
         	<center>
            	Logged as 
    			<a title="Click for Profile" id="edit" target="_self" href="index.php?action=staffdetails&email=<?php echo $email;?>">
                <?php $user=mysql_fetch_array(mysql_query("SELECT staff_image from staffs_info where email = '$email'"));?>
                <?php 
					if($_SESSION['fname'])
					{			
						echo $_SESSION["fname"];
						echo " ";
						echo $_SESSION["lname"];
					}
				?>	
                 </a>
                 <a class="fancybox" data-fancybox-group="gallery" href="source/images/staffs/<?php echo $user['staff_image'];?>" title="View Full Sized">
                	<img width="30" height="30" src="source/images/staffs/<?php echo $user['staff_image']; ?>" />
                </a>
	           
            </center>    	
 <form name="control" action="logout.php"  method="post" >    				
    <input class="btn btn-info"  title="Go Home Page." id="logoutButton" type="submit" name="btn_home"  value="Home">
    <input onclick="return logout()" class="btn btn-info"  title="Click to Signout." id="logoutButton" type="submit" name="btn_logout" value="Logout">			
            </form> 
           <a href="http://www.openweathermap.org" target="_new" title="Weather Source: www.openweathermap.org">
             	<div id="weather" class="weatherData">
					<marquee behaviour = "alternate"> 
						Loding Weather Data
				 </marquee>
                </div>
             </a>            
	      </div> <!-- end of user div-->         
</div> <!-- end of header div-->         	 
<div class="clear">
</div>