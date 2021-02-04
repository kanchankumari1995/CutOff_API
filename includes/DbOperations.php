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
		function createUser($username, $email, $pass, $mobile)
		{
			$password = md5($pass);

			//create a statement
			$stmt = $this->con->prepare("INSERT INTO `vm_users` (`u_id`, `u_name`, `u_email`, `u_password`, `u_mobile`) VALUES (NULL, ?, ?, ?, ?)");


			//now we will bind the actual perameters that is needed for the quries
			//and we can use it, we can bind the paremeters using the bind param method 
			//bind the parameter to the sql quary
			$stmt->bind_Param("ssss",$username,$email,$password,$mobile);

			if($stmt->execute()){
				return true;
			}else{
				return false;
			}

		}
	}