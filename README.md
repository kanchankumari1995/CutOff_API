# CutOff_API
API of internship cutoff project 


<b> cutoff_App Post requests with parameters </b>

 1. to register user following is url and parameters.<br><br>
 <b>url</b><br>
 localhost/CutOff_api/v1/registerUser.php<br>       
 <b>param</b><br>
        {<br>
	"username":"Kanchan Kumari",<br>
	"useremail":"kanchankumawat@gmail.com",<br>
	"userpassword": "12345678"<br>
        "usermobile": "7727054815"<br>
        }<br><br>
  <b>response</b><br>
        {<br>
         "success": true,<br>
          "Data": {<br>
                 "userid": 1349,<br>
                 "username": "Kanchan",<br>
                 "useremail": "k@gmail.com",<br>
                 "usermobile": "7727054815"<br>
                  }<br>
         }
