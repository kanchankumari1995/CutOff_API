<?php

require_once '../includes/DbOperations.php';
$response = array(); 
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['username']) and isset($_POST['useremail']) and isset($_POST['userpassword']) and isset($_POST['usermobile']))
	{
			$db = new DbOperation();
			$result = $db->createUser($_POST['username'],$_POST['useremail'],$_POST['userpassword'],$_POST['usermobile']);
			if($result == 1)
			{
					$userData = $db->getUserByUserEmail($_POST['useremail']);
					$response['success'] = true;
					$responseData['userid'] = $userData['u_id'];
					$responseData['username'] = $userData['u_name'];
					$responseData['useremail'] = $userData['u_email'];
					$responseData['usermobile'] = $userData['u_mobile'];
					$response['Data'] = $responseData;
					
			}
			elseif ($result == 2) 
			{
					$response['success'] = false;
					$response['messege'] = 'Registration Failed';
			}
			else
			{
					$response['success'] = false;
					$response['messege'] = "It seems you have already registered, Choose different Phone Number and Email";
			}
	}
	else
	{	
			$response['success'] = false;
			$response['messege'] = "Required fields are missing";
	}
				
}else{
	$response['success'] = false;
	$response['messege'] = "Invalid Request";
}
echo json_encode($response);