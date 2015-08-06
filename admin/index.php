<?php
	error_reporting(1);	
	include 'main.php';		
?>
<html>
  <head>
    <title>Library :: Dashboard</title>
    <?php include 'includes/dependencies.php'; ?>
  </head>
  <body>
  <div class="wrapper">
      <!--Header Div-->
      <?php include('boxes/header.php');?>
      <!--Header Div Ends-->
     
     <!--Main content Div-->
     <?php include('boxes/content.php');?>
     <!--Main content Div Ends-->
     
     <!--Footer Div-->
     <?php include('boxes/footer.php');?>
     <!--Footer Div Ends-->
  </div>
  </body>
</html>