//as we are going to store the data to the database  
// for storing the database we use http post method
//$SERVER['REQUEST_METHOD']   its a predefine array
<?php

//method will be eual to post if there is a post request
//what if there is not a post request we will display some error message
//for the error messege difine array here

require_once '../includes/DbOperations.php';

$response = array(); //this is a assosiative array
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	echo "Hello";
	if(isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['mobile']))
		{
				//if all these three keys are set than that means user has provided all the required values and we can
				// operate the data further
				// we will insert into the database
				//for the database we need DbOperation.php script here so we will import it 

				//here we will create a db operations object
				$db = new DbOperation();

				// and with this object we will call the method create user


				//this method well return ether true or false so again we will put inside in if 
				if($db->createUser($_POST['username'],$_POST['email'],$_POST['password'],$_POST['mobile']))
				{
						$response['error'] = false;
						$response['messege'] = "User registered successfully";
				}else{

					$response['error'] = true;
					$response['messege'] = "Some error occurred please try again ";
				}
					


		}else{
				//but if the control come inside this else that means used has not provided all the required values 
				// in this case we will again display an error
				$response['error'] = true;
				$response['messege'] = "Required fields are missing";
		}
				
}else{
	$response['error'] = true;
	$response['messege'] = "Invalid Request";
}


//and finaly we can display the response in JSON formate, we need some data interchange formate to communicate from another devise with this web services and JSON is the most populor formate used these days and it is super easy and light wight , so to display this array in JSON formate just write echo json_ecode and pass the array, it will autometacaly encode this array in json formate and display it to inside the browser 


echo json_encode($response);