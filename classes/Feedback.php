<?php

class Feedback{
	
	public $name;
	public $email;
	public $description;
	public $mobile; 
	private $conn;
	private $table_name; 
	public function __construct($conn){
		
		$this->conn = $conn; 
		$this->table_name = 'feedback_db'; // tb name
		 
	}  
	  
	public function feedback_user()
	{
		$sql = mysqli_query($this->conn,"Insert into ".$this->table_name . "(id,name,email,mobile,description) value ('','$this->name','$this->email','$this->mobile','$this->description')");  
		if($sql){ 
			return true;   
		}else{ 
			return false; 
		}
			
	}
}


?>