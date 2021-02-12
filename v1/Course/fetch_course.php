<?php

require_once '../../Includes/DbOperations.php';
$response = array();
if($_SERVER['REQUEST_METHOD'] =='GET')
{
	$db = new DbOperation();
	$result = $db->FetchCourse();
	if(!result)
	{
		$response['Success'] = false;
		$response['message'] = 'No course found';
	}
	else
	{
		echo $result;
	}
}
else
{
	$response['Success'] = false;
	$response['message'] = 'Invalid Request';
	echo json_encode($response);
}