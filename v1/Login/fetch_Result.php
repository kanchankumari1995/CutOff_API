<?php

require_once '../../Includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD'] =='POST')
{
	if(isset($_POST['useremail']) and isset($_POST['userpassword']))
	{
		
		$db = new DbOperation();
		$response = $db->userLogin($_POST['useremail'],$_POST['userpassword']);
		if($response ==null)
		{
			$response['success'] = false;
			$response['message'] = "Some error occured";
		}
	}
	else
	{
		$response['success'] = false;
		$response['message'] = "Required Fileds are missing";
	}
}
else
{
	$response['success'] = false;
	$response['message'] = 'Invalide Request';
}
echo json_encode($response);
?>