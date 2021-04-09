<?php

ini_set('display_errors',1); 
//include header 
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=utf-8");  

//includes
include('../config/db.php');
include('../classes/Feedback.php'); 

//get connection 
$dbcon = new DabaseConnection(); 
$conn = $dbcon->connect();  
 
//passing connection 
$Feedback = new Feedback($conn);      

if($_SERVER['REQUEST_METHOD'] == 'POST'){    
	
	$data =   json_decode(file_get_contents("php://input"));
	
	if(!empty($data->name) && !empty($data->email) && !empty($data->mobile) && !empty($data->description)){
		
		$Feedback->name = $data->name; 
		$Feedback->email = $data->email;  
		$Feedback->mobile = $data->mobile;  
		$Feedback->description = $data->description;  
		
         
			if($Feedback->feedback_user()){ 
				http_response_code(201);  
				echo json_encode(array("status"=>1,"message"=>'Inserted Successfully'));
			}else{ 
				http_response_code(500); 
				echo json_encode(array("status"=>0,"message"=>'Something went wrong')); 
			}
		
		
	}else{ 
		http_response_code(404);
		echo json_encode(array("status"=>0,"message"=>'All fields are required'));
	}
	 
}else{ 
	
	http_response_code(505);
	echo json_encode(array("status"=>0,"message"=>"Access Denied")); 
	
}

?>