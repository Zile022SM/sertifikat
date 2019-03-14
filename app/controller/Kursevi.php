<?php
class Kursevi extends Controller{
 	public function __construct(){
 		$this->kursModel=$this->model('Kurs');
 	}
    
 	public function insert(){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
 		
 	    //u promenljivu $formData stavljamo $_POST 
        $formData = $_POST;
            
	    //ovde se smestaju greske koje imaju polja u formi
        $formErrors = array();
            
 		if($_SERVER['REQUEST_METHOD']=='POST'){
 			
 			if (isset($formData["click"]) && $formData["click"] == "Save"){
 				
 			   /*********** filtriranje i validacija polja ****************/
               // DUZINA TRAJANJA KURSA SRPSKI
	           if (isset($formData["duzina_trajanja_srp"])) {
		           //Filtering 1
				   $formData["duzina_trajanja_srp"] = trim($formData["duzina_trajanja_srp"]);
		           $formData["duzina_trajanja_srp"] = strip_tags($formData["duzina_trajanja_srp"]);

			        //Validation - if required
			        if ($formData["duzina_trajanja_srp"] === "") {
				        $formErrors["duzina_trajanja_srp"][] = "Ime je obavezno!!!";
			        }else{
	                  if(mb_strlen($formData["duzina_trajanja_srp"])>255){
	                  	  $formErrors["duzina_trajanja_srp"][] = "Ime ne sme imati vise od 255 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["duzina_trajanja_srp"][] = "Ime mora biti prosledjeno!!!";
	           }
 				
 			   /*********** filtriranje i validacija polja ****************/
               // DUZINA TRAJANJA KURSA ENGLESKI
	           if (isset($formData["duzina_trajanja_eng"])) {
		           //Filtering 1
				   $formData["duzina_trajanja_eng"] = trim($formData["duzina_trajanja_eng"]);
		           $formData["duzina_trajanja_eng"] = strip_tags($formData["duzina_trajanja_eng"]);

			        //Validation - if required
			        if ($formData["duzina_trajanja_eng"] === "") {
				        $formErrors["duzina_trajanja_eng"][] = "Prezime je obavezno!!!";
			        }else{
	                  if(mb_strlen($formData["duzina_trajanja_eng"])>255){
	                  	  $formErrors["duzina_trajanja_eng"][] = "Titula ne sme imati vise od 255 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["duzina_trajanja_eng"][] = "Prezime mora biti prosledjeno!!!";
	           } 
	           
 			   /*********** filtriranje i validacija polja ****************/
               // NAZIV KURSA SRPSKI
	           if (isset($formData["naziv_srp"])) {
		           //Filtering 1
				   $formData["naziv_srp"] = trim($formData["naziv_srp"]);
		           $formData["naziv_srp"] = strip_tags($formData["naziv_srp"]);

			        //Validation - if required
			        if ($formData["naziv_srp"] === "") {
				        $formErrors["naziv_srp"][] = "Broj je obavezan!!!";
			        }else{
	                  if(mb_strlen($formData["naziv_srp"])>255){
	                  	  $formErrors["naziv_srp"][] = "Broj ne sme imati vise od 255 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["naziv_srp"][] = "Broj mora biti prosledjen!!!";
	           } 
	           
 			   /*********** filtriranje i validacija polja ****************/
               // NAZIV KURSA ENGLESKI
	           if (isset($formData["naziv_eng"])) {
		           //Filtering 1
				   $formData["naziv_eng"] = trim($formData["naziv_eng"]);
		           $formData["naziv_eng"] = strip_tags($formData["naziv_eng"]);

			        //Validation - if required
			        if ($formData["naziv_eng"] === "") {
				        $formErrors["naziv_eng"][] = "Email je obavezan!!!";
			        }else{
				        if(mb_strlen($formData["naziv_eng"])>255){
		                  	  $formErrors["naziv_eng"][] = "Broj ne sme imati vise od 255 karaktera!!!";
		                }
	                }
	           } else {
                     //if required
		             $formErrors["naziv_eng"][] = "Prezime mora biti prosledjeno!!!";
	           }
	           
 			   /*********** filtriranje i validacija polja ****************/
               // OPIS SRPSKI
			    if (isset($formData["opis_srp"])) {
					//Filtering 1
					$formData["opis_srp"] = trim($formData["opis_srp"]);
			        $formData["opis_srp"] = strip_tags($formData["opis_srp"], "<br><br/><h1></h1><h2></h2><h3></h3><p></p><em></em><strong></strong>");
			        if (mb_strlen($formData["opis_srp"])>65000){
			        	$formErrors["opis_srp"][] = "Opis ne sme imati vise od 65000 karaktera!!!";
			        }
				}
				
 			   /*********** filtriranje i validacija polja ****************/
               // OPIS ENGLESKI
			    if (isset($formData["opis_eng"])) {
					//Filtering 1
					$formData["opis_eng"] = trim($formData["opis_eng"]);
			        $formData["opis_eng"] = strip_tags($formData["opis_eng"], "<br><br/><h1></h1><h2></h2><h3></h3><p></p><em></em><strong></strong>");
			        if (mb_strlen($formData["opis_eng"])>65000){
			        	$formErrors["opis_eng"][] = "Opis ne sme imati vise od 65000 karaktera!!!";
			        }
				}
 			   
			    
			    //UKOLIKO NEMA GRESAKA
 			    if (empty($formErrors)){
 			  	//OVDE SNIMAMO KURS AKO JE SVE USPESNO
 			  	  $data=array(
 			  	  'duzina_trajanja_srp'=>$formData["duzina_trajanja_srp"],
 			  	  'duzina_trajanja_eng'=>$formData["duzina_trajanja_eng"],
 			  	  'naziv_srp'=>$formData["naziv_srp"],
 			  	  'naziv_eng'=>$formData["naziv_eng"],
 			  	  'opis_srp'=>$formData["opis_srp"],
 			  	  'opis_eng'=>$formData["opis_eng"]
 			  	  );
 			  	  $snimi=$this->kursModel->insertKursa($data);
 			  	  
 			  	  if (!$snimi){
 			  	  	$data=array(
 			  	  	'status'=>'Desila se greska prilikom snimanja kursa'
 			  	  	);
 			  	  	$this->view('admin/kursevi/insert', $data);
 			  	  }else{
 			  	  	$kursevi=$this->kursModel->getKursevi();
			 		$data=array(
			 		'kursevi'=>$kursevi,
			 		'status'=>'Uspesno snimeljen kurs'
			 		);
			 		$this->view('admin/kursevi/lista', $data);
 			  	  }
 			  	  
 			    }else{
 			    	
 			  	//OVDE HVATAMO GRESKE AKO IH IMA I FORMIRAMO NIZ $DATA=array();
 			  	$data=array();
 			    if(!empty($formErrors["duzina_trajanja_srp"])){
 			    	$data['duzina_trajanja_srp_error']=$formErrors["duzina_trajanja_srp"];
 			    	$data['duzina_trajanja_srp']=$formData["duzina_trajanja_srp"];
                }
 			    if(!empty($formErrors["duzina_trajanja_eng"])){
 			    	$data['duzina_trajanja_eng_error']=$formErrors["duzina_trajanja_eng"];
 			    	$data['duzina_trajanja_eng']=$formData["duzina_trajanja_eng"];
                }
 			    if(!empty($formErrors["naziv_srp"])){
 			    	$data['naziv_srp_error']=$formErrors["naziv_srp"];
 			    	$data['naziv_srp']=$formData["naziv_srp"];
                }
 			    if(!empty($formErrors["naziv_eng"])){
 			    	$data['naziv_eng_error']=$formErrors["naziv_eng"];
 			    	$data['naziv_eng']=$formData["naziv_eng"];
                }
 			    if(!empty($formErrors["opis_srp"])){
 			    	$data['opis_srp_error']=$formErrors["opis_srp"];
 			    	$data['opis_srp']=$formData["opis_srp"];
                }
 			    if(!empty($formErrors["opis_eng"])){
 			    	$data['opis_eng_error']=$formErrors["opis_eng"];
 			    	$data['opis_eng']=$formData["opis_eng"];
                }
                
 			  	$this->view('admin/kursevi/insert', $data);
 			  }

 			}else{
 				//OVO JE USLOV AKO NEKO POKUSA DA SABMITUJE FORMU SA NE VAZECIM VREDNOSTIMA
 				//VRACAMO GA SAMO NAZAD NA FORMU BEZ IKAKVE AKCIJE
 				$data=array(
 				'obavestenje'=>"Zlonameran pokusaj"
 				);
 			    $this->view('admin/kursevi/insert', $data);
 			}
 		}else{
 			//OVO JE USLOV AKO SE SAMO KLIKNE NA LINK UNESI KURS,SAMO NAS PROSLEDI NA STRANU ZA UNOS
 			$data=array();
 		    $this->view('admin/kursevi/insert', $data);
 		}
 		
 		}
 	}
  
    public function lista(){
    	if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
 			$kursevi=$this->kursModel->getKursevi();
	 		$data=array(
	 		'kursevi'=>$kursevi
	 		);
	 		$this->view('admin/kursevi/lista', $data);
 		}
 		
 	}
 	
    public function showEdit($id){
    	if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
 		$idKursa=$id;
 		$kurs=$this->kursModel->kursById($idKursa);
 		if (!empty($kurs)){
 			$data=array(
 			'id'=>$idKursa,
 	  	    'duzina_trajanja_srp'=>$kurs->duzina_trajanja_srp,
 	  	    'duzina_trajanja_eng'=>$kurs->duzina_trajanja_eng,
 	  	    'naziv_srp'=>$kurs->naziv_srp,
 	  	    'naziv_eng'=>$kurs->naziv_eng,
 	  	    'opis_srp'=>$kurs->opis_srp,
 	  	    'opis_eng'=>$kurs->opis_eng
 	  	    );
 		    $this->view('admin/kursevi/edit', $data);
 		}else{
 			$data=array(
 			"greska"=>"Nije pronadjen kurs"
 			);
 			$this->view('admin/kursevi/edit', $data);
 		}
 	  }
 	}
 	
    public function edit(){
    	if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
	        //ovde se smestaju greske koje imaju polja u formi
            $formErrors = array();
            //u promenljivu $formData stavljamp $_POST
            $formData = $_POST; 
            
            $id=$formData['id'];
 			if (isset($formData["click"]) && $formData["click"] == "Edit"){
 				
 			   /*********** filtriranje i validacija polja ****************/
               // DUZINA TRAJANJA KURSA SRPSKI
	           if (isset($formData["duzina_trajanja_srp"])) {
		           //Filtering 1
				   $formData["duzina_trajanja_srp"] = trim($formData["duzina_trajanja_srp"]);
		           $formData["duzina_trajanja_srp"] = strip_tags($formData["duzina_trajanja_srp"]);

			        //Validation - if required
			        if ($formData["duzina_trajanja_srp"] === "") {
				        $formErrors["duzina_trajanja_srp"][] = "Ime je obavezno!!!";
			        }else{
	                  if(mb_strlen($formData["duzina_trajanja_srp"])>255){
	                  	  $formErrors["duzina_trajanja_srp"][] = "Ime ne sme imati vise od 255 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["duzina_trajanja_srp"][] = "Ime mora biti prosledjeno!!!";
	           }
 				
 			   /*********** filtriranje i validacija polja ****************/
               // DUZINA TRAJANJA KURSA ENGLESKI
	           if (isset($formData["duzina_trajanja_eng"])) {
		           //Filtering 1
				   $formData["duzina_trajanja_eng"] = trim($formData["duzina_trajanja_eng"]);
		           $formData["duzina_trajanja_eng"] = strip_tags($formData["duzina_trajanja_eng"]);

			        //Validation - if required
			        if ($formData["duzina_trajanja_eng"] === "") {
				        $formErrors["duzina_trajanja_eng"][] = "Prezime je obavezno!!!";
			        }else{
	                  if(mb_strlen($formData["duzina_trajanja_eng"])>255){
	                  	  $formErrors["duzina_trajanja_eng"][] = "Titula ne sme imati vise od 255 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["duzina_trajanja_eng"][] = "Prezime mora biti prosledjeno!!!";
	           } 
	           
 			   /*********** filtriranje i validacija polja ****************/
               // NAZIV KURSA SRPSKI
	           if (isset($formData["naziv_srp"])) {
		           //Filtering 1
				   $formData["naziv_srp"] = trim($formData["naziv_srp"]);
		           $formData["naziv_srp"] = strip_tags($formData["naziv_srp"]);

			        //Validation - if required
			        if ($formData["naziv_srp"] === "") {
				        $formErrors["naziv_srp"][] = "Broj je obavezan!!!";
			        }else{
	                  if(mb_strlen($formData["naziv_srp"])>255){
	                  	  $formErrors["naziv_srp"][] = "Broj ne sme imati vise od 255 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["naziv_srp"][] = "Broj mora biti prosledjen!!!";
	           } 
	           
 			   /*********** filtriranje i validacija polja ****************/
               // NAZIV KURSA ENGLESKI
	           if (isset($formData["naziv_eng"])) {
		           //Filtering 1
				   $formData["naziv_eng"] = trim($formData["naziv_eng"]);
		           $formData["naziv_eng"] = strip_tags($formData["naziv_eng"]);

			        //Validation - if required
			        if ($formData["naziv_eng"] === "") {
				        $formErrors["naziv_eng"][] = "Email je obavezan!!!";
			        }else{
				        if(mb_strlen($formData["naziv_eng"])>255){
		                  	  $formErrors["naziv_eng"][] = "Broj ne sme imati vise od 255 karaktera!!!";
		                }
	                }
	           } else {
                     //if required
		             $formErrors["naziv_eng"][] = "Prezime mora biti prosledjeno!!!";
	           }
	           
 			   /*********** filtriranje i validacija polja ****************/
               // OPIS SRPSKI
			    if (isset($formData["opis_srp"])) {
					//Filtering 1
			    	if ($formData["naziv_eng"] === "") {
			    		$formErrors["opis_srp"][] = "Opis ne sme imati vise od 65000 karaktera!!!";
			    	}else{
					$formData["opis_srp"] = trim($formData["opis_srp"]);
			        $formData["opis_srp"] = strip_tags($formData["opis_srp"], "<br><br/><h1></h1><h2></h2><h3></h3><p></p><em></em><strong></strong>");
			        if (mb_strlen($formData["opis_srp"])>65000){
			        	$formErrors["opis_srp"][] = "Opis ne sme imati vise od 65000 karaktera!!!";
			        }
			       } 
				}
				
 			   /*********** filtriranje i validacija polja ****************/
               // OPIS ENGLESKI
			    if (isset($formData["opis_eng"])) {
					//Filtering 1
					$formData["opis_eng"] = trim($formData["opis_eng"]);
			        $formData["opis_eng"] = strip_tags($formData["opis_eng"], "<br><br/><h1></h1><h2></h2><h3></h3><p></p><em></em><strong></strong>");
			        if (mb_strlen($formData["opis_eng"])>65000){
			        	$formErrors["opis_eng"][] = "Opis ne sme imati vise od 65000 karaktera!!!";
			        }
				}
 			   
			    //UKOLIKO NEMA GRESAKA
 			    if (empty($formErrors)){
 			  	//OVDE SNIMAMO KURS AKO JE SVE USPESNO
 			  	  $data=array(
 	  	          'duzina_trajanja_srp'=>$formData["duzina_trajanja_srp"],
 	  	          'duzina_trajanja_eng'=>$formData["duzina_trajanja_eng"],
 	  	          'naziv_srp'=>$formData["naziv_srp"],
 	  	          'naziv_eng'=>$formData["naziv_eng"],
 	  	          'opis_srp'=>$formData["opis_srp"],
 	  	          'opis_eng'=>$formData["opis_eng"]
	 	  	      ); 
 	  	    
 			  	  $snimi=$this->kursModel->editKursa($data,$id);
 			  	  
 			  	  if (!$snimi){
 			  	  	$data=array(
 			  	  	'status'=>'Desila se greska prilikom snimanja kursa'
 			  	  	);
 			  	  	$this->view('admin/kursevi/edit', $data);
 			  	  }else{
 			  	  	$kursevi=$this->kursModel->getKursevi();
			 		$data=array(
			 		'kursevi'=>$kursevi,
			 		'status'=>'Uspesno snimeljen kurs'
			 		);
			 		$this->view('admin/kursevi/lista', $data);
 			  	  }
 			    }else{
	 			    $idKursa=$id;
 		            $kurs=$this->kursModel->kursById($idKursa);
	 			  	//OVDE HVATAMO GRESKE AKO IH IMA I FORMIRAMO NIZ $DATA=array();
	 			  	$data=array();
	 			    if(!empty($formErrors["duzina_trajanja_srp"])){
	 			    	$data['duzina_trajanja_srp_error']=$formErrors["duzina_trajanja_srp"];
	                }else{
	                	$data['duzina_trajanja_srp']=$kurs->duzina_trajanja_srp;
	                }
	 			    if(!empty($formErrors["duzina_trajanja_eng"])){
	 			    	$data['duzina_trajanja_eng_error']=$formErrors["duzina_trajanja_eng"];
	                }else{
	                	$data['duzina_trajanja_eng']=$kurs->duzina_trajanja_eng;
	                }
	 			    if(!empty($formErrors["naziv_srp"])){
	 			    	$data['naziv_srp_error']=$formErrors["naziv_srp"];
	                }else{
	                	$data['naziv_srp']=$kurs->naziv_srp;
	                }
	 			    if(!empty($formErrors["naziv_eng"])){
	 			    	$data['naziv_eng_error']=$formErrors["naziv_eng"];
	                }else{
	                	$data['naziv_eng']=$kurs->naziv_eng;
	                }
	 			    if(!empty($formErrors["opis_srp"])){        
	 			    	$data['opis_srp_error']=$formErrors["opis_srp"];
	                }else{
	                	$data['opis_srp']=$kurs->opis_srp;
	                } 
 			        if(!empty($formErrors["opis_eng"])){
	 			    	$data['opis_eng_error']=$formErrors["opis_eng"];
	                }else{
	                	$data['opis_eng']=$kurs->opis_eng;
	                }
 			  	    $this->view('admin/kursevi/edit', $data);
 			  }

 			}else{
 				//OVO JE USLOV AKO NEKO POKUSA DA SABMITUJE FORMU SA NE VAZECIM VREDNOSTIMA
 				//VRACAMO GA SAMO NAZAD NA FORMU BEZ IKAKVE AKCIJE
 				$data=array(
 				'obavestenje'=>"Zlonameran pokusaj"
 				);
 			    $this->view('admin/kursevi/edit', $data);
 			}
 		}
 	}
 	
 	
 	public function delete($id){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
	 		$idKursa=$id;
	 		$delete=$this->kursModel->deleteKursa($idKursa);
	 		$kursevi=$this->kursModel->getKursevi();
	 		$data=array(
	 		'kursevi'=>$kursevi
	 		);
	 		$this->view('admin/kursevi/lista', $data);
 	    }
 	}	
 	
 }