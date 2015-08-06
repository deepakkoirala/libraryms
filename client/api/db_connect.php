<?php

	class db_connect
	{
		function construct()
		{
			
		}
		function destruct()
		{
			$this->close();
		}
		public function connect()
		{
			require_once 'constants.php';
			$con = mysql_connect(HOST,USER,PASS) or die(mysql_error());
			mysql_select_db(DBNAME) or die(mysql_error());
			return $con;			
		}
		public function close()
		{
			mysql_close();
		}
	}

?>