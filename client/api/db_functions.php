<?php	
	class db_functions
	{
		private $db;
		
		function __construct()
		{
			include_once './db_connect.php';
			$this->db = new db_connect;
			$this->db->connect();
		}

		function __destruct()
		{			
		}

		public function login($email,$password)
		{
			try{					
					$result = mysql_query("SELECT * from members_info where email = '$email' and password = '$password'");					
					return $result;
			}catch(Exception $ex){
				return null;
			}
		}

		public function getBookByTAS($title,$author,$subject)
		{
			try{					
					$result = mysql_query("SELECT * from books_info where title like '$title%' and authors like '$author%' and subject like '$subject%' order by title");
				
					return $result;
			}catch(Exception $ex){
				return null;
			}
		}
		public function getBookByA($author)
		{
			try{					
					$result = mysql_query("SELECT * from books_info where authors like '$author%' order by title");
				
					return $result;
			}catch(Exception $ex){
				return null;
			}
		}
		public function getBookByT($title)
		{
			try{					
					$result = mysql_query("SELECT * from books_info where title like '$title%' order by title");
				
					return $result;
			}catch(Exception $ex){
				return null;
			}
		}
		public function getBookByS($subject)
		{
			try{					
					$result = mysql_query("SELECT * from books_info where subject like '$subject%' order by title");
				
					return $result;
			}catch(Exception $ex){
				return null;
			}
		}

		public function get_book_by_an($an)
		{

			try{
					
					$result = mysql_query("SELECT * from books_info where accession_no = '$an'");
					return $result;
			}catch(Exception $ex){
				return null;
			}
		}
		public function add_new_wishlist($email,$title,$author,$desc,$notify)
		{
			try{
				date_default_timezone_set("Asia/Kolkata"); 
				$time = date('l, jS F Y, h:i:s A',time()+900);						
				
				$result = mysql_query("INSERT into wishlists_info values('','$email','$title','$author','$desc','$notify','$time','','')");
				return $result;
			}catch(Exception $ex){
				return null;
			}
		}
		public function delete_all_wishlist($email)
		{
			try{				
				$result = mysql_query("DELETE from wishlists_info where email = '$email'");
				return $result;
			}catch(Exception $ex){
				return null;
			}
		}
		public function get_wishlist($email)
		{

			try{
					
					$result = mysql_query("SELECT * from wishlists_info where email = '$email'");
					return $result;
			}catch(Exception $ex){
				return null;
			}
		}
		public function get_mybooks($email)
		{

			try{
					$libid = mysql_fetch_array(mysql_query("SELECT lib_id from members_info where email = '$email'"));
					$result = mysql_query("SELECT * from issued where lib_id = '$libid[0]'");					
					return $result;
			}catch(Exception $ex){
				return null;
			}
		}
		public function get_allBooks()
		{

			try{
					$books = mysql_query("SELECT * from books_info");					
					return $books;
			}catch(Exception $ex){
				return null;
			}
		}
		public function recover_account($email)
		{
			try{					
					$findpass = mysql_query("SELECT password from members_info where email = '$email'");										
					return $findpass;						
					
			}catch(Exception $ex){
				return null;
			}
		}
		public function change_password($email)
		{
			try{					
					$finduser = mysql_query("SELECT * from members_info where email = '$email'");										
					return $finduser;						
					
			}catch(Exception $ex){
				return null;
			}
		}
		
		
		
		
		
		
		
		
	}	
?>