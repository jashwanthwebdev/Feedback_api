<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile= $_POST['mobile'];
	$description = $_POST['description']; 
	
	if(!empty($name) && !empty($email) && !empty($mobile) && !empty($description)){
		
		$data = array("name"=>$name,"email"=>$email,"mobile"=>$mobile,"description"=>$description);
		$fields_string = json_encode($data);
	//	echo $fields_string;
	//	exit;  
		//open connection 
		$ch = curl_init(); 
        
		$url = 'http://localhost/Feedback_PHP_Api/v1/Feedback_api.php'; 
	
		curl_setopt($ch,CURLOPT_URL, $url); 
		curl_setopt($ch,CURLOPT_POST, true); 
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);   
       
		//execute post  
		$result = curl_exec($ch);  
		$final_result = json_decode($result);  
		
		if($final_result->status == '1'){
			echo '<script> alert("Thanks For Your Valuable Feedback"); window.location.href=""; </script>'; 
		}else{
			echo '<script> alert("Sorry Something went wrong.."); window.location.href=""; </script>';
		}  
       		
		
	}else{
		
		echo '<script> alert("Name and Mobile Fields are manditatory"); window.location.href=""; </script>'; 
	}
	
	
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body> 

<div class="container">  
   <h2>REST API CREATION</h2>
   <div class="col-md-6">
  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" >  
    <div class="form-group">  
      <label for="email">Name:</label> 
      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
    </div>
    <div class="form-group">
      <label for="pwd">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div> 
	<div class="form-group">
      <label for="pwd">Mobile:</label>
      <input type="number" class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile">
    </div>
	<div class="form-group">
  <label for="comment">Comment:</label>
  <textarea class="form-control" rows="5" id="description" name="description"></textarea>
</div>

    
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  </div> 
</div>

</body>
</html>