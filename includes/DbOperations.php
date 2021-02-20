<?php

	class DbOperation{

		private $con;
		private $response;
		private $responseData;

		function __construct()
		{
			 require_once dirname(__File__).'/DbConnect.php';
			 $db = new DbConnect(); 
			 $this->con = $db->connect();
		}


		/*CRUD -> C ->CREATE */

		//insert record in the database table user
		function createUser($username, $useremail, $userpassword, $usermobile)
		{
			if($this->isUserExist($useremail,$usermobile))
			{
				return 0;
			}
			else
			{
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
			echo 'hello';
			//echo $stmt->num_rows;
			return $stmt->num_rows > 0;

		}
		public function getUserByUserEmail($useremail)
		{

			$stmt = $this->con->prepare("SELECT * FROM vm_users WHERE u_email = ?");
			$stmt->bind_param("s",$useremail);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		public function userLogin($email,$pass)
		{
			$response = array();
			$responseData = array();
			$stmt = $this->con->prepare("SELECT u_id from vm_users WHERE u_email = ? and u_password = ?");
			$stmt->bind_param("ss",$email,$pass);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows>0)
			{
				$response["success"] = true;
				$result = $this->con->query("SELECT * FROM vm_users WHERE u_email ='".$email."'");
				$row = $result->fetch_assoc();
				$responseData['userid'] = $row['u_id'];
				$responseData['username'] = $row['u_name'];
				$responseData['useremail'] = $row['u_email'];
				$responseData['usermobile'] = $row['u_mobile'];
				

				$response['Data'] = $responseData;
				return $response;
			}
			else
			{
				$response['success'] = false;
				$response['message'] = "Either Email or password is Incorrect!";
				return $response;
			}
		}

		public function FetchCourse()
		{
			$response = array();
			$stmt = $this->con->prepare("SELECT * from `course`");
			$stmt->execute();
			$stmt->bind_result($courseId,$courseName,$courseOrder,$courseIcon,$courseURL);
			$Services = array();
			while($stmt->fetch()){
				$temp = array();
				$temp['courseId'] = $courseId;
				$temp['courseName'] = $courseName;
				$temp['courseOrder'] = $courseOrder;
				$temp['courseIcon'] = $courseIcon;
				$temp['courseURL'] = $courseURL;
				array_Push($Services,$temp);	
			}
			
			$response = $Services;
			return json_encode($response);
		}

	}
