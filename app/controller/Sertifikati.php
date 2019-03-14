<?php 

 class Sertifikati extends Controller{
 	public function __construct(){
 		$this->sertifikatModel=$this->model('Sertifikat');
 	}
 	
 	public function rezultat(){
 		if ($_SERVER['REQUEST_METHOD']=='POST'){
 			$data=$_POST['broj_sertifikata'];
 			$rezultat=$this->sertifikatModel->rezultat($data);
 			if (!empty($rezultat)){
 				$rezultat=$this->sertifikatModel->rezultat($data);
 				$idKursa=$rezultat->kurs_id;
 				$profesori=$this->sertifikatModel->profesori($idKursa);
	 			$data=array(
	 			'data'=>$rezultat,
	 			'profesori'=>$profesori,
	 			'status'=>'srpski'
	 			);
	 			$this->view('sertifikati/sertifikat',$data);
 			}else{
 				$data=array(
 				'greska'=>'Nije pronadjen sertifikat pod ovim brojem',
 				'greska_eng'=>'No certificate found under this number'
 				);
 				$this->view('index',$data);
 			}
 		}
 	}
 	
 	public function srpski($data){
 		    $rezultat=$this->sertifikatModel->rezultat($data);
 		    $idKursa=$rezultat->kurs_id;
 			$profesori=$this->sertifikatModel->profesori($idKursa);
 			if (!empty($rezultat)){
 				$data=array(
 			    'data'=>$rezultat,
 			    'profesori'=>$profesori,
 			    'status'=>'srpski'
 			    );
 				$this->view('sertifikati/sertifikat',$data);
 			}else{
 				$data=array(
 				'greska'=>'Nije pronadjen sertifikat pod ovim brojem',
 				'greska_eng'=>'No certificate found under this number'
 				);
 				$this->view('index',$data);
 			}
 	}
 	
    public function engleski($data){
 		    $rezultat=$this->sertifikatModel->rezultat($data);
 		    $idKursa=$rezultat->kurs_id;
 		    $profesori=$this->sertifikatModel->profesori($idKursa);
 			if (!empty($rezultat)){
 				$data=array(
 			    'data'=>$rezultat,
 			    'profesori'=>$profesori,
 			    'status'=>'engleski'
 			    );
 		        $this->view('sertifikati/sertifikat',$data);
 			}else{
 				$data=array(
 				'greska'=>'Nije pronadjen sertifikat pod ovim brojem',
 				'greska_eng'=>'No certificate found under this number'
 				);
 				$this->view('index',$data);
 			}
 			
 	}
 	
 	public function profesor($id,$jezik){
 		    $jezik=$jezik;
	 		$profesor=$this->sertifikatModel->profesorById($id);  
	 		if (!empty($profesor) && !empty($id)){
	 			$data=array(
		 		'profesor'=>$profesor,
		 		'jezik'=>$jezik
		 		);
		 		$this->view('sertifikati/profesor',$data);
	 		}else{
	 			$data=array(
	 			'jezik'=>$jezik
		 		);
	 			$this->view('sertifikati/profesor',$data);
	 		}
 	}
 	
 }