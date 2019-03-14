<?php
 class Users extends Controller{
 	public function __construct(){
 		$this->userModel=$this->model('User');
 		$this->profesorModel=$this->model('Profesor');
 		$this->polaznikModel=$this->model('Polaznik');
 		$this->kursModel=$this->model('Kurs');
 		$this->diplomaModel=$this->model('Diploma');
 		$this->rasporedModel=$this->model('Raspored');
 	}
 	
 	public function login(){
	 	if($_SERVER['REQUEST_METHOD']=='POST'){
	 			//Proces form
	 			$_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
	 			
	 			$data=array(
	 			   'email'=>trim($_POST['email']),
	 			   'password'=>trim($_POST['password']),
	 			   'email_err'=>'',
	 			   'password_err'=>'',
 			    );
 			
	 	    if(empty($data['email'])){
 				$data['email_err']='Please enter email';
 			}
	 	    if(empty($data['password'])){
 				$data['password_err']='Please enter password';
 			}
 			
 			if ($this->userModel->findUserByEmail($data['email'])){
 				
 			}else{
 				$data['email_err']="User not found";
 			}
 			
 			if (empty($data['email_err'])&& empty($data['password_err'])){
 				$user=$this->userModel->login($data['email'],$data['password']);
 				if ($user){
 					$this->createUserSession($user);
 				}else{
 					$data['password_err']="Email or password is incorrect";
 					$this->view('admin/users/login', $data);
 				}
 			}else{
 				$this->view('admin/users/login', $data);
 			}
 			
 			
	 		}else{
	 			$data=array(
	 			   'email'=>'',
	 			   'password'=>'',
	 			   'email_error'=>'',
	 			   'password_error'=>'',
	 			);
	 			
	 			$this->view('admin/users/login',$data);
	 		}
	 	}
	 	
	 	public function createUserSession($user){
	 		$_SESSION['user_id']=$user->id;
	 		$_SESSION['user_email']=$user->email;
	 		$_SESSION['user_name']=$user->ime;
	 		$_SESSION['user_lastname']=$user->prezime;
	 		
	 		$profesori=$this->profesorModel->getProfesori();
	 		$polaznici=$this->polaznikModel->getPolaznici();
	 		$kursevi=$this->kursModel->getKursevi();
	 		$sertifikati=$this->diplomaModel->getSertifikati();
	 		$rasporedi=$this->rasporedModel->getRasporedi();
	 		$data=array(
	 		'profesori'=>$profesori,
	 		'polaznici'=>$polaznici,
	 		'kursevi'=>$kursevi,
	 		'sertifikati'=>$sertifikati,
	 		'rasporedi'=>$rasporedi
	 		);
	 		$this->view('admin/index', $data);
	 	}
	 	
	 	public function logout(){
	 		unset($_SESSION['user_id']);
	 		unset($_SESSION['user_email']);
	 		unset($_SESSION['user_name']);
	 		unset($_SESSION['user_lastname']);
	 		session_destroy();
	 		$this->view('admin/users/login');
	 	}
	 	
	 	
 }