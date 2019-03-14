<?php 

 class Admin extends Controller{
 	public function __construct(){
 		$this->profesorModel=$this->model('Profesor');
 		$this->polaznikModel=$this->model('Polaznik');
 		$this->kursModel=$this->model('Kurs');
 		$this->diplomaModel=$this->model('Diploma');
 		$this->rasporedModel=$this->model('Raspored');
 	}
 	
 	
 	public function index(){ 
 	    if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
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
 		
 	}
 }