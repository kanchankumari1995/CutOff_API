<?php

	class DbOperation{

		private $con;

		function __construct()
		{
			 require_once dirname(__File__).'/DbConnect.php';

			 $db = new DbConnect(); 

			 $this->con = $db->connect();
		}


		/*CRUD -> C ->CREATE */

		//insert record in the database table user
		function createUser($username, $useremail, $pass, $usermobile)
		{
			if($this->isUserExist($useremail,$usermobile))
			{
				return 0;
			}
			else
			{
				$userpassword = md5($pass);

				//create a statement
				$stmt = $this->con->prepare("INSERT INTO `vm_users` (`u_id`, `u_name`, `u_email`, `u_password`, `u_mobile`) VALUES (NULL, ?, ?, ?, ?)");
				$stmt->bind_Param("ssss",$username,$useremail,$userpassword,$usermobile);

				if($stmt->execute())
				{
					return 1;
				}
				else
				{
					echo $this->con->error;
					return 2;
				}
			}

		}
		public function isUserExist($useremail,$usermobile)
		{
			$stmt = $this->con->prepare("SELECT u_id from vm_users WHERE u_email = ? or u_mobile = ?");
			$stmt->bind_Param("ss",$useremail,$usermobile);
			$stmt->execute();
			$stmt->store_result();
			echo $stmt->num_rows;
			return $stmt->num_rows > 0;
		}
		public function getUserByUserEmail($useremail)
		{

			$stmt = $this->con->prepare("SELECT * FROM vm_users WHERE u_email = ?");
			$stmt->bind_param("s",$useremail);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}

	}