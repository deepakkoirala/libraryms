<?php 
	session_start(); 	
	include 'log.php';
	
	if(isset($_SESSION['email']) and checkAdmin($_SESSION['email']))
	{
		header('location:'.site_url.'/admin/');
	}
	
	include 'includes/dependencies.php';

	if(isset($_POST['login_submit']))
	{
		$message = "";
		$error = '<b>Error</b> : Invalid Username or Password ! <font color="black"> Hint:</font> <font color="purple">Use Admin Account</font> <br><br><a href="mailto:thapasujan5@gmail.com"  class= "btn btn-primary" >Contact Developer</a>';
		
    	$username = mysql_real_escape_string($_POST['username']);
	    $password = mysql_real_escape_string($_POST['password']);
    
	    $query = "select * from staffs_info where email = '$username' && password = '$password'";
	    $result = mysql_query($query) or die(mysql_error());
    	$numrows = mysql_numrows($result);
		
	    if($numrows>0)
    	{
			
			if(checkAdmin($username)){
        	$row = mysql_fetch_assoc($result);
	        $_SESSION['email'] = $row['email'];
			$_SESSION['fname'] = $row['fname'];
			$_SESSION['lname'] = $row['lname'];
			
			$action = "Login_Admin";
			$item = $_SESSION['email'];
			$desc = "Admin:".$_SESSION['fname'].' '.$_SESSION['lname']." Logged in Successfully ";
			logLogin($action,$item,$desc);
			logStaff($action,$item,$desc);
			logSystem($action,$item,$desc);				
			logAdmin($action,$item,$desc);
			
		    header('Location:index.php');
			exit;
			}else{
				$message = $error; }
    	}
	    else
		{ 
			$action = "Login";
			$item = $username;
			$desc = "Login Unsuccessful using Email:$username and Password:$password";
			logLogin($action,$item,$desc);				
			logSystem($action,$item,$desc);	       
        	$message = $error;    	    
	    }	
}
function checkAdmin($username)
	{				

		$email = $username;
		$check = mysql_fetch_array(mysql_query("SELECT position from staffs_info where email = '$email'"));
		$position = $check[0];			
		if($position == 'Head Librarian' or $position == 'Admin')					
		{
			return true;
		}
		return false;
	}
?>
<html>
  <head>
    <title>Library :: Admin Login</title>
  </head>
  <body>     
  <h1 class="alert alert-info"> <center>Library Admin Login</center></h1>
     <div class="loginForm">	 
   <form role="form" name="loginForm" method="post" onSubmit="return checkData(this)" action="">
    <table border="0px" align="center">
      <tr>
        <th colspan="2"><h2 class="form-signin-heading">Please sign in</h2> </th>
      </tr>
      <tr>        
        <td colspan="2">
        	<div class="input-group-lg">
	 			<input type="email" name ="username" class="form-control" placeholder="Email address" required autofocus>
            </div>
       </td>               
      </tr>
      <tr>
        <td colspan="2">
            <input id="tbPass" class="input-lg form-control" type="password" placeholder ="Password" name="password" required></td>       
      </tr>
      <tr>        
        <td colspan="2"> <input id="btnLogin" class="btn btn-primary" type="submit" name="login_submit" value="Login"></td>	        
       </tr>
       <?php if($message!="") {?>
       <tr>
        <td colspan="2"> <div class="message">
          <b>  <?php if($message!="") { echo $message;} ?></b>
              </div>
        </td>
      </tr>
      <?php }?>
     </table>
    </form>
     </div>
     <?php
 		include('boxes/footer.php');
	 ?>     
  </body>
</html>
 <script>
		$('#tbPass').hidePassword(true);
</script>