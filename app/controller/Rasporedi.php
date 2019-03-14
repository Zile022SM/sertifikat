<?php 


 class Rasporedi extends Controller{
 	public function __construct(){
 		$this->kursModel=$this->model('Kurs');
 		$this->profesorModel=$this->model('Profesor');
 		$this->rasporedModel=$this->model('Raspored');
 	}
 	
 	public function insert(){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
 		    $profesoriForSelet=$this->profesorModel->getProfesoriForSelect();
 		    $kurseviForSelect=$this->kursModel->getKurseviForSelect();
	 	    //u promenljivu $formData stavljamo $_POST 
	        $formData = $_POST;
	            
		    //ovde se smestaju greske koje imaju polja u formi
	        $formErrors = array();
            
 		if($_SERVER['REQUEST_METHOD']=='POST'){
 			
 			if (isset($formData["click"]) && $formData["click"] == "Save"){
 				
 			    /*********** filtriranje i validacija polja ****************/
			    // PROFESOR
			    if (isset($formData["profesor"])) {
			        //Filtering 1
					$formData["profesor"] = trim($formData["profesor"]);
			        $formData["profesor"] = strip_tags($formData["profesor"]);
				
					
					//Validation - if required
					if ($formData["profesor"] === "") {
						$formErrors["profesor"][] = "Izaberite profesora!!!";
					}
					
					if (!array_key_exists($formData["profesor"], $profesoriForSelet)) {
						$formErrors["profesor"][] = "Pogresan profesor!!!";
					}
					
				} else {
			        //if required
					$formErrors["profesor"][] = "Profesor mora biti prosledjen!!!";
				} 
				
 			    /*********** filtriranje i validacija polja ****************/
			    // KURS
			    if (isset($formData["kurs"])) {
			        //Filtering 1
					$formData["kurs"] = trim($formData["kurs"]);
			        $formData["kurs"] = strip_tags($formData["kurs"]);
				
					
					//Validation - if required
					if ($formData["kurs"] === "") {
						$formErrors["kurs"][] = "Izaberite kurs!!!";
					}
					
					if (!array_key_exists($formData["kurs"], $kurseviForSelect)) {
						$formErrors["kurs"][] = "Pogresan kurs!!!";
					}
					
				} else {
			        //if required
					$formErrors["kurs"][] = "Kurs mora biti prosledjen!!!";
				}
 			   
	           
 			    /*********** filtriranje i validacija polja ****************/
                // DATUM POCETKA
	            if (isset($formData["pocetak"])) {
		           //Filtering 1
				   $formData["pocetak"] = trim($formData["pocetak"]);
		           $formData["pocetak"] = strip_tags($formData["pocetak"]);

			        //Validation - if required
			        if ($formData["pocetak"] === "") {
				        $formErrors["pocetak"][] = "Datum pocetka je obavezan!!!";
			        }
	            } else {
                     //if required
		             $formErrors["pocetak"][] = "Datum pocetka mora biti prosledjen!!!";
	            } 
	            
 			    /*********** filtriranje i validacija polja ****************/
                // DATUM ZAVRSETKA
	            if (isset($formData["zavrsetak"])) {
		           //Filtering 1
				   $formData["zavrsetak"] = trim($formData["zavrsetak"]);
		           $formData["zavrsetak"] = strip_tags($formData["zavrsetak"]);

			        //Validation - if required
			        if ($formData["zavrsetak"] === "") {
				        $formErrors["zavrsetak"][] = "Datum zavrsetka je obavezan!!!";
			        }
	            } else {
                     //if required
		             $formErrors["zavrsetak"][] = "Datum zavrsetka mora biti prosledjen!!!";
	            }
			    
			    //UKOLIKO NEMA GRESAKA
 			    if (empty($formErrors)){
 			  	//OVDE SNIMAMO RASPORED AKO JE SVE USPESNO
 			  	  $data=array(
 			  	  'id_kursa'=>$formData["kurs"],
 			  	  'id_profesora'=>$formData["profesor"],
 			  	  'datum_pocetka'=>$formData["pocetak"],
 			  	  'datum_zavrsetka'=>$formData["zavrsetak"],
 			  	  );
 			  	  $this->rasporedModel->insertRasporeda($data);
 			  	  $rasporedi=$this->rasporedModel->getRasporedi();
 			  	  $data=array(
 			  	  'rasporedi'=>$rasporedi
 			  	  );
 			  	  $this->view('admin/raspored/list', $data);
 			  	  
 			    }else{
 			    	
 			  	//OVDE HVATAMO GRESKE AKO IH IMA I FORMIRAMO NIZ $DATA=array();
 			  	$profesori=$this->profesorModel->getProfesori();
		 		$kursevi=$this->kursModel->getKursevi();
		 		$data=array(
		 		'profesori'=>$profesori,
		 		'kursevi'=>$kursevi
		 		);
		 		
 			    if(!empty($formErrors["profesor"])){
 			    	$data['profesor_error']=$formErrors["profesor"];
                }else{
                	$data['profesor']=$formData["profesor"];
                }
                
 			    if(!empty($formErrors["kurs"])){
 			    	$data['kurs_error']=$formErrors["kurs"];
                }else{
                	$data['kurs']=$formData["kurs"];
                }
                
 			    if(!empty($formErrors["pocetak"])){
 			    	$data['pocetak_error']=$formErrors["pocetak"];
                }else{
                	$data['pocetak']=$formData["pocetak"];
                } 
                
 			    if(!empty($formErrors["zavrsetak"])){
 			    	$data['zavrsetak_error']=$formErrors["zavrsetak"];
                }else{
                	$data['zavrsetak']=$formData["zavrsetak"];
                }
                
 			  	$this->view('admin/raspored/insert', $data);
 			  }

 			}else{
 				//OVO JE USLOV AKO NEKO POKUSA DA SABMITUJE FORMU SA NE VAZECIM VREDNOSTIMA
 				//VRACAMO GA SAMO NAZAD NA FORMU BEZ IKAKVE AKCIJE
 				$data=array(
 				'status'=>"Zlonameran pokusaj"
 				);
 			    $this->view('admin/raspored/insert', $data);
 			}
 		}else{
 			//OVO JE USLOV AKO SE SAMO KLIKNE NA LINK UNESI RASPORED,SAMO NAS PROSLEDI NA STRANU ZA UNOS
 			$kursevi=$this->kursModel->getKursevi();
 			$profesori=$this->profesorModel->getProfesori();
 		
	 		$data=array(
	 		'kursevi'=>$kursevi,
	 		'profesori'=>$profesori
	 		);
	 		$this->view('/admin/raspored/insert', $data);
	 	}
 	  }
 	}
 	
 	public function lista(){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
	 		$rasporedi=$this->rasporedModel->getRasporedi();
	 		$data=array(
	 		'rasporedi'=>$rasporedi
	 		);
	 		$this->view('admin/raspored/list', $data);
 		}
 	}
 	
    public function showEdit($id){
    	if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
 		$idKursaiPredavaca=$id;
 		$kurs=$this->rasporedModel->rasporedById($idKursaiPredavaca);
 		$profesori=$this->profesorModel->getProfesori();
		$kursevi=$this->kursModel->getKursevi();
 		if (!empty($kurs)){
 			$data=array(
 			'id'=>$idKursaiPredavaca,
 	  	    'id_kursa'=>$kurs->id_kursa,
 	  	    'id_predavaca'=>$kurs->id_predavaca,
 	  	    'pocetak'=>$kurs->datum_pocetka,
 	  	    'zavrsetak'=>$kurs->datum_zavrsetka,
 			'profesori'=>$profesori,
 			'kursevi'=>$kursevi
 	  	    );
 		    $this->view('admin/raspored/edit', $data);
 		}else{
 			$data=array(
 			"greska"=>"Nije pronadjen kurs"
 			);
 			$this->view('admin/raspored/edit', $data);
 		}
 	  }
 	}
 	
 	public function edit(){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
	        //ovde se smestaju greske koje imaju polja u formi
            $formErrors = array();
            
            //u promenljivu $formData stavljamo $_POST sa forme
            $formData = $_POST; 
            
            $id=$formData['id'];
            
 			if (isset($formData["click"]) && $formData["click"] == "Edit"){
 				
 			   /*********** filtriranje i validacija polja ****************/
			    // PROFESOR
			    if (isset($formData["id_predavaca"])) {
			        //Filtering 1
					$formData["id_predavaca"] = trim($formData["id_predavaca"]);
			        $formData["id_predavaca"] = strip_tags($formData["id_predavaca"]);
				
					
					//Validation - if required
					if ($formData["id_predavaca"] === "") {
						$formErrors["id_predavaca"][] = "Izaberite profesora!!!";
					}
					
				} else {
			        //if required
					$formErrors["id_predavaca"][] = "Profesor mora biti prosledjen!!!";
				} 
				
 			    /*********** filtriranje i validacija polja ****************/
			    // KURS
			    if (isset($formData["id_kursa"])) {
			        //Filtering 1
					$formData["id_kursa"] = trim($formData["id_kursa"]);
			        $formData["id_kursa"] = strip_tags($formData["id_kursa"]);
				
					
					//Validation - if required
					if ($formData["id_kursa"] === "") {
						$formErrors["id_kursa"][] = "Izaberite kurs!!!";
					}
					
				} else {
			        //if required
					$formErrors["id_kursa"][] = "Kurs mora biti prosledjen!!!";
				}
 			   
	           
 			    /*********** filtriranje i validacija polja ****************/
                // DATUM POCETKA
	            if (isset($formData["pocetak"])) {
		           //Filtering 1
				   $formData["pocetak"] = trim($formData["pocetak"]);
		           $formData["pocetak"] = strip_tags($formData["pocetak"]);

			        //Validation - if required
			        if ($formData["pocetak"] === "") {
				        $formErrors["pocetak"][] = "Datum pocetka je obavezan!!!";
			        }
	            } else {
                     //if required
		             $formErrors["pocetak"][] = "Datum pocetka mora biti prosledjen!!!";
	            } 
	            
 			    /*********** filtriranje i validacija polja ****************/
                // DATUM ZAVRSETKA
	            if (isset($formData["zavrsetak"])) {
		           //Filtering 1
				   $formData["zavrsetak"] = trim($formData["zavrsetak"]);
		           $formData["zavrsetak"] = strip_tags($formData["zavrsetak"]);

			        //Validation - if required
			        if ($formData["zavrsetak"] === "") {
				        $formErrors["zavrsetak"][] = "Datum zavrsetka je obavezan!!!";
			        }
	            } else {
                     //if required
		             $formErrors["zavrsetak"][] = "Datum zavrsetka mora biti prosledjen!!!";
	            } 
			    
			    //UKOLIKO NEMA GRESAKA
 			    if (empty($formErrors)){
 			    	
 			  	//OVDE SNIMAMO RASPORED AKO JE SVE USPESNO
 			  	  $data=array(
 			  	  'id'=>$id,
 			  	  'id_predavaca'=>$formData["id_predavaca"],
 			  	  'id_kursa'=>$formData["id_kursa"],
 			  	  'pocetak'=>$formData["pocetak"],
 			  	  'zavrsetak'=>$formData["zavrsetak"]
 			  	  );
 			  	  $snimi=$this->rasporedModel->editRasporeda($data);
 			  	  
 			  	  if (!$snimi){
 			  	  	$data=array(
 			  	  	'status'=>'Desila se greska prilikom snimanja profesora'
 			  	  	);
 			  	  	$this->view('admin/raspored/edit', $data);
 			  	  }else{
 			  	  	  $rasporedi=$this->rasporedModel->getRasporedi();
	 			  	  $data=array(
	 			  	  'rasporedi'=>$rasporedi
	 			  	  );
			 		  $this->view('admin/raspored/list', $data);
 			  	  }
 			    }else{
	 			    $idKursaiPredavaca=$formData['id'];
	 			    $kurs=$this->rasporedModel->rasporedById($idKursaiPredavaca);
 		            $profesori=$this->profesorModel->getProfesori();
		            $kursevi=$this->kursModel->getKursevi();
	 			  	//OVDE HVATAMO GRESKE AKO IH IMA I FORMIRAMO NIZ $DATA=array();
	 			  	$data=array(
	 			  	'profesori'=>$profesori,
	 			  	'kursevi'=>$kursevi,
	 			  	);
	 			    if(!empty($formErrors["id_predavaca"])){
	 			    	$data['id_predavaca_error']=$formErrors["id_predavaca"];
	                }else{
	                	$data['id_predavaca']=$kurs->id_predavaca;
	                }
	 			    if(!empty($formErrors["id_kursa"])){
	 			    	$data['id_kursa_error']=$formErrors["id_kursa"];
	                }else{
	                	$data['id_kursa']=$kurs->id_kursa;
	                }
	 			    if(!empty($formErrors["pocetak"])){
	 			    	$data['pocetak_error']=$formErrors["pocetak"];
	                }else{
	                	$data['pocetak']=$kurs->datum_pocetka;
	                }
	 			    if(!empty($formErrors["zavrsetak"])){
	 			    	$data['zavrsetak_error']=$formErrors["zavrsetak"];
	                }else{
	                	$data['zavrsetak']=$kurs->datum_zavrsetka;
	                }
	 		
 			  	  $this->view('admin/raspored/edit', $data);
 			  }

 			}else{
 				//OVO JE USLOV AKO NEKO POKUSA DA SABMITUJE FORMU SA NE VAZECIM VREDNOSTIMA
 				//VRACAMO GA SAMO NAZAD NA FORMU BEZ IKAKVE AKCIJE
 				$data=array(
 				'obavestenje'=>"Zlonameran pokusaj"
 				);
 			    $this->view('admin/raspored/edit', $data);
 			}
 		}
 	}
 	
    public function delete($id){
    	if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
 		$idRasporeda=$id;
 		$this->rasporedModel->deleteRasporeda($idRasporeda);
 		$rasporedi=$this->rasporedModel->getRasporedi();
 		$data=array(
 		'rasporedi'=>$rasporedi
 		);
 		$this->view('admin/raspored/list', $data);
 	  }
 	}
 }
 	
