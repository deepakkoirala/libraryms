<?php
	error_reporting(0);
	include 'log.php';
	session_start();		

	if(($_SESSION["fname"]))
		{
			header('Location:'.site_url);
		}			
	
	$message = "";		
	 
	if (isset($_POST['send']))
	{		
		$email = mysql_real_escape_string($_POST['txtemail']);		
		$password = mysql_real_escape_string($_POST['txtpass']);	
		$checkdb = mysql_query("SELECT * from staffs_info");
		if(mysql_num_rows($checkdb) == 0){
			$message = "Currently there are no Users Created Yet. Please Contact Developer !";
		}else
		{
		
			$query = mysql_query("SELECT * FROM staffs_info WHERE email='$email' AND password='$password'");
			$row = mysql_fetch_array($query);
			if(is_array($row))
			{
				$_SESSION["fname"] = $row['fname']; //extracting first name
				$_SESSION["lname"] = $row['lname']; //extracting last name		
				$_SESSION["email"] = $email;
				$_SESSION["url"] = site_url;

				$action = "Login";
				$item = $_SESSION['email'];
				$desc = "Staff:".$_SESSION['fname'].' '.$_SESSION['lname']." Logged in Successfully ";
				logLogin($action,$item,$desc);
				logStaff($action,$item,$desc);
				logSystem($action,$item,$desc);	
				if(checkAdmin1()){
					logAdmin($action,$item,$desc);
				}
				header('Location:'.site_url);
			}
			else
			{	
				$action = "Login";
				$item = $email;
				$desc = "Login Unsuccessful using Email:$email and Password:$password";
				logLogin($action,$item,$desc);				
				logSystem($action,$item,$desc);	
				$message = "Wrong Email or Password !";			
			}
		}
	}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Library :: Login</title>
    <?php include_once 'includes/dependencies.php';?>
    
  </head>
 <body <?php if(isset($_SESSION['fname'])) echo "onLoad=\"focusLogin()\"";?>> 
 <div id="wrapper" style="width:100%;">
 	<div class="header">
    	<div class="logo">
        	<a  title="Visit official Site" href="<?php echo site_url; ?>" target="_new">
	            <img src="source/images/logo1.gif"  alt="Logo" title="Logo" align="left" >
            </a>
        </div>  <!--  end of logo -->  
	    <div class="titleLogin">
    		<?php
				if(isset($_SESSION['fname']))
				{
					echo "<h1>Library Panel</h1>";
				}
				else
				{
					echo "<h1> Library Management System</h1>";
				}    	    
						
			?>
	     </div> <!--  end of title -->    
    	<div id="dateTime">
        </div> 	    

	 </div>
     <div class="clear">
     </div>     
     <br />
    <br />
    <br />
   <div class="loginForm">	 
   <form role="form" name="loginForm" method="post" onSubmit="return checkData(this)" action="login.php">
    <table border="0px" align="center">
      <tr>      	        
        <th colspan="2"><h2 class="form-signin-heading">Please sign in</h2> </th>        
      </tr>
      <tr>        
        <td colspan="2">

			<div class="input-group-lg">
	 			<input type="email" name ="txtemail" class="form-control" placeholder="Email address" required autofocus>
            </div>
            </td>
       </tr>
      <tr>       
        <td colspan="2">
        		<div class="input-group-lg">
	            	<input id= "tbPass" class="input-lg form-control" type="password" placeholder ="Password" name="txtpass" required>            
                </div>                
            </td> 
      </tr>
      <tr>        
        <td colspan="2"> <input id="btnLogin" title="Click to Login" class="btn btn-primary" type="submit" name="send" value="Login"></td>	     
       </tr>   
        <?php if($message!=""){?>
        <tr>
        <td colspan="3" align="center"> <div class="message">
         <b><font color="red">  <?php if($message!="") { echo $message;} ?></b></font>
          </div>
        </td>
      </tr>
      <?php }?>
     </table>
    </form>
</div>
<?php
 	include('includes/footer.php');
 ?>
</body>
</html>