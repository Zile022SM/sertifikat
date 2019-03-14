<?php 


 class Certificate extends Controller{
 	public function __construct(){
 		$this->polaznikModel=$this->model('Polaznik');
 		$this->kursModel=$this->model('Kurs');
 		$this->diplomaModel=$this->model('Diploma');
 		
 	}
 	
 	public function insert(){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
 	        $polaznici=$this->polaznikModel->getPolazniciForSelect();
	 		$kursevi=$this->kursModel->getKurseviForSelect();
	 		$data=array(
		 		'polaznici'=>$polaznici,
		 		'kursevi'=>$kursevi
	 	    ); 
		 	 
	 	    //u promenljivu $formData stavljamo $_POST 
	        $formData = $_POST;
	            
		    //ovde se smestaju greske koje imaju polja u formi
	        $formErrors = array();
            
 		if($_SERVER['REQUEST_METHOD']=='POST'){
 			
 			if (isset($formData["click"]) && $formData["click"] == "Save"){
 				
 			    /*********** filtriranje i validacija polja ****************/
			    // category_id
			    if (isset($formData["polaznik"])) {
			        //Filtering 1
					$formData["polaznik"] = trim($formData["polaznik"]);
			        $formData["polaznik"] = strip_tags($formData["polaznik"]);
				
					
					//Validation - if required
					if ($formData["polaznik"] === "") {
						$formErrors["polaznik"][] = "Izaberite polaznika!!!";
					}
					
					if (!array_key_exists($formData["polaznik"], $polaznici)) {
						$formErrors["polaznik"][] = "Pogresan polaznik!!!";
					}
					
				} else {
			        //if required
					$formErrors["polaznik"][] = "Polaznik mora biti prosledjen!!!";
				} 
				
 			    /*********** filtriranje i validacija polja ****************/
			    // category_id
			    if (isset($formData["kurs"])) {
			        //Filtering 1
					$formData["kurs"] = trim($formData["kurs"]);
			        $formData["kurs"] = strip_tags($formData["kurs"]);
				
					
					//Validation - if required
					if ($formData["kurs"] === "") {
						$formErrors["kurs"][] = "Izaberite kurs!!!";
					}
					
					if (!array_key_exists($formData["kurs"], $kursevi)) {
						$formErrors["kurs"][] = "Pogresan kurs!!!";
					}
					
				} else {
			        //if required
					$formErrors["kurs"][] = "Kurs mora biti prosledjen!!!";
				}
 			   
	           
 			    /*********** filtriranje i validacija polja ****************/
                // DATUM
	            if (isset($formData["datum"])) {
		           //Filtering 1
				   $formData["datum"] = trim($formData["datum"]);
		           $formData["datum"] = strip_tags($formData["datum"]);

			        //Validation - if required
			        if ($formData["datum"] === "") {
				        $formErrors["datum"][] = "Datum je obavezan!!!";
			        }
	            } else {
                     //if required
		             $formErrors["datum"][] = "Datum mora biti prosledjen!!!";
	            }
 			   
			    
			    //UKOLIKO NEMA GRESAKA
 			    if (empty($formErrors)){
 			  	//OVDE SNIMAMO POLAZNIKA AKO JE SVE USPESNO
 			  	  $data=array(
 			  	  'polaznik_id'=>$formData["polaznik"],
 			  	  'kurs_id'=>$formData["kurs"],
 			  	  'broj_sertifikata'=>rand ( 100000000 , 999999999 ),
 			  	  'datum_dobijanja'=>$formData["datum"],
 			  	  );
 			  	  //$snimi=$this->diplomaModel->insertSertifikata($data);
 			  	  $proveraBroja=$this->diplomaModel->proveraBroja();
 			  	  if ($proveraBroja->broj==$data['broj_sertifikata']){
	 			  	  	$polaznici=$this->polaznikModel->getPolaznici();
			 		    $kursevi=$this->kursModel->getKursevi();
				 		$data=array(
				 		'polaznici'=>$polaznici,
				 		'kursevi'=>$kursevi,
				 		'status'=>'Vec je unet sertifikat pod ovim brojem'
				 		);
 			  	  	    $this->view('admin/sertifikatiAdmin/insert', $data);
 			  	  }else{
 			  	  	$this->diplomaModel->insertSertifikata($data);
 			  	  	$listaSertifikata=$this->diplomaModel->getSertifikati();
			 		$data=array(
			 		'lista'=>$listaSertifikata
			 		);
			 		$this->view('admin/sertifikatiAdmin/lista', $data);
 			  	  }
 			  	  
 			    }else{
 			    	
 			  	//OVDE HVATAMO GRESKE AKO IH IMA I FORMIRAMO NIZ $DATA=array();
 			  	$polaznici=$this->polaznikModel->getPolaznici();
		 		$kursevi=$this->kursModel->getKursevi();
		 		$data=array(
		 		'polaznici'=>$polaznici,
		 		'kursevi'=>$kursevi
		 		);
		 		
 			    if(!empty($formErrors["polaznik"])){
 			    	$data['polaznik_error']=$formErrors["polaznik"];
                }else{
                	$data['polaznik']=$formData["polaznik"];
                }
                
 			    if(!empty($formErrors["kurs"])){
 			    	$data['kurs_error']=$formErrors["kurs"];
                }else{
                	$data['kurs']=$formData["kurs"];
                }
                
 			    if(!empty($formErrors["datum"])){
 			    	$data['datum_error']=$formErrors["datum"];
                }else{
                	$data['datum']=$formData["datum"];
                }
                
 			  	$this->view('admin/sertifikatiAdmin/insert', $data);
 			  }

 			}else{
 				//OVO JE USLOV AKO NEKO POKUSA DA SABMITUJE FORMU SA NE VAZECIM VREDNOSTIMA
 				//VRACAMO GA SAMO NAZAD NA FORMU BEZ IKAKVE AKCIJE
 				$data=array(
 				'status'=>"Zlonameran pokusaj"
 				);
 			    $this->view('admin/sertifikatiAdmin/insert', $data);
 			}
 		}else{
 			//OVO JE USLOV AKO SE SAMO KLIKNE NA LINK UNESI SERTIFIKAT,SAMO NAS PROSLEDI NA STRANU ZA UNOS
 			$polaznici=$this->polaznikModel->getPolaznici();
	 		$kursevi=$this->kursModel->getKursevi();
	 		$data=array(
	 		'polaznici'=>$polaznici,
	 		'kursevi'=>$kursevi
	 		);
	 		$this->view('admin/sertifikatiAdmin/insert', $data);
	 	 }
 	   }
 	} 
 	
 	public function lista(){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
	 		$listaSertifikata=$this->diplomaModel->getSertifikati();
	 		$data=array(
	 		'lista'=>$listaSertifikata
	 		);
	 		$this->view('admin/sertifikatiAdmin/lista', $data);
 		}
 	}
 	
    public function delete($id){
    	if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
	 		$idSertifikata=$id;
	 		$this->diplomaModel->deleteSertifikata($idSertifikata);
	 		$listaSertifikata=$this->diplomaModel->getSertifikati();
	 		$data=array(
	 		'lista'=>$listaSertifikata
	 		);
	 		$this->view('admin/sertifikatiAdmin/lista', $data);
 		}
 	}
 }
 	
