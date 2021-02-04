//for connecting with the 
<?php
	
	class DbConnect{

		private $con;

		function __construct(){

		}

		function connect(){
			//inside this method first we will include our file Constants.php
			include_once dirname(__File__).'/Constants.php';
			$this->con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);



			//this method will return the error that accured in connecting with the database
			if(mysqli_connect_errno()){
				echo "Failed to connect with database".mysqli_connect_err();
			}

			//end if there isn't any error we will return the con variable
			return $this->con; 

		}
	}