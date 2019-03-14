<?php

class User{
	private $db;
	
	private $FIND_USER_BY_EMAIL="SELECT * FROM `users` WHERE email=:email";
	
	private $REGISTER_USER="INSERT INTO `users` (`name`, `email`, `password`) VALUES (:name,:email,:password);";
	
	private $LOGIN_USER="SELECT * FROM users WHERE email=:email AND password=:password";
	
	public function __construct(){
		$this->db=Database::createInstance();
	}
	
	public function register($data){
		$statement =$this->db->prepare($this->REGISTER_USER);
		$statement->bindParam(':name', $data['name']);
		$statement->bindParam(':email', $data['email']);
		$statement->bindParam(':password', $data['password']);
		
		if($statement->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	public function login($email,$password){
		$statement =$this->db->prepare($this->LOGIN_USER);
		$statement->bindParam(':email', $email);
		$statement->bindParam(':password', $password);
		$statement->execute();
		$result=$statement->fetch();
		
		
		if (!empty($result)){
			return $result;
		}else{
			return false;
		}
	}
	
	public function findUserByEmail($email){
		$statement =$this->db->prepare($this->FIND_USER_BY_EMAIL);
		$statement->bindParam(':email', $email);
		$statement->execute();
		$result=$statement->fetch();
		$test=$statement->rowCount();
		
		if ($test >0){
			return true;
		}else{
			return false;
		}
	}
}

?>