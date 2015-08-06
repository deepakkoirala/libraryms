<div class="main_content">
  <?php 
   if(isset($_GET['page']))
  {
    $page = $_GET['page'].'.php';
    include('pages/'.$page);
	
  }
  else
  {
    ?>
    <div class="user_manager manager_wrapper">
    <h2 class="content_title">Welcome to Library Admin Dashboard</h2></div>
    <?php
  }  
  ?>
</div>