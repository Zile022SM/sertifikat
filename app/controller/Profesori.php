<?php
class Profesori extends Controller{
 	public function __construct(){
 		$this->profesorModel=$this->model('Profesor');
 	}
    
 	public function insert(){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
 		//u promenljivu $formData stavljamo $_POST iz forme
        $formData = $_POST; 
            
	    //ovde se smestaju greske koje imaju polja u formi
        $formErrors = array();
            
 		if($_SERVER['REQUEST_METHOD']=='POST'){
 			
 			if (isset($formData["click"]) && $formData["click"] == "Save"){
 				
 			   /*********** filtriranje i validacija polja ****************/
               // TITULA SRPSKI
	           if (isset($formData["titula_srp"])) {
		           //Filtering 1
				   $formData["titula_srp"] = trim($formData["titula_srp"]);
		           $formData["titula_srp"] = strip_tags($formData["titula_srp"]);

			        //Validation - if required
			        if ($formData["titula_srp"] === "") {
				        $formErrors["titula_srp"][] = "Titula je obavezna!!!";
			        }else{
	                  if(mb_strlen($formData["titula_srp"])>20){
	                  	  $formErrors["titula_srp"][] = "Titula ne sme imati vise od 20 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["titula_srp"][] = "Titula mora biti prosledjena!!!";
	           }
 				
 			   /*********** filtriranje i validacija polja ****************/
               // TITULA ENGLESKI
	           if (isset($formData["titula_eng"])) {
		           //Filtering 1
				   $formData["titula_eng"] = trim($formData["titula_eng"]);
		           $formData["titula_eng"] = strip_tags($formData["titula_eng"]);

			        //Validation - if required
			        if ($formData["titula_eng"] === "") {
				        $formErrors["titula_eng"][] = "Titula je obavezna!!!";
			        }else{
	                  if(mb_strlen($formData["titula_eng"])>20){
	                  	  $formErrors["titula_eng"][] = "Titula ne sme imati vise od 20 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["titula_eng"][] = "Titula mora biti prosledjena!!!";
	           } 
	           
 			   /*********** filtriranje i validacija polja ****************/
               // IME
	           if (isset($formData["ime"])) {
		           //Filtering 1
				   $formData["ime"] = trim($formData["ime"]);
		           $formData["ime"] = strip_tags($formData["ime"]);

			        //Validation - if required
			        if ($formData["ime"] === "") {
				        $formErrors["ime"][] = "Ime je obavezno!!!";
			        }else{
	                  if(mb_strlen($formData["ime"])>20){
	                  	  $formErrors["ime"][] = "Ime ne sme imati vise od 20 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["ime"][] = "Ime mora biti prosledjeno!!!";
	           } 
	           
 			   /*********** filtriranje i validacija polja ****************/
               // PREZIME
	           if (isset($formData["prezime"])) {
		           //Filtering 1
				   $formData["prezime"] = trim($formData["prezime"]);
		           $formData["prezime"] = strip_tags($formData["prezime"]);

			        //Validation - if required
			        if ($formData["prezime"] === "") {
				        $formErrors["prezime"][] = "Prezime je obavezno!!!";
			        }else{
	                  if(mb_strlen($formData["prezime"])>20){
	                  	  $formErrors["prezime"][] = "Prezime ne sme imati vise od 20 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["prezime"][] = "Prezime mora biti prosledjeno!!!";
	           }
	           
 			   /*********** filtriranje i validacija polja ****************/
               // OPIS SRPSKI
			    if (isset($formData["editor1"])) {
					//Filtering 1
					$formData["editor1"] = trim($formData["editor1"]);
			        $formData["editor1"] = strip_tags($formData["editor1"], "<br><br/><h1></h1><h2></h2><h3></h3><p></p><em></em><strong></strong>");
			        if (mb_strlen($formData["editor1"])>65000){
			        	$formErrors["editor1"][] = "Opis ne sme imati vise od 65000 karaktera!!!";
			        }
				}
				
 			   /*********** filtriranje i validacija polja ****************/
               // OPIS ENGLESKI
			    if (isset($formData["editor2"])) {
					//Filtering 1
					$formData["editor2"] = trim($formData["editor2"]);
			        $formData["editor2"] = strip_tags($formData["editor2"], "<br><br/><h1></h1><h2></h2><h3></h3><p></p><em></em><strong></strong>");
			        if (mb_strlen($formData["editor2"])>65000){
			        	$formErrors["editor2"][] = "Opis ne sme imati vise od 65000 karaktera!!!";
			        }
				}
	           
 			  /*********** filtriranje i validacija polja ****************/
              // SLIKA
		      if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) {
				if (empty($_FILES["image"]["error"])) {
					//filtering
					$imageFileTmpPath = $_FILES["image"]["tmp_name"];
					$imageFileName = basename($_FILES["image"]["name"]);
					$imageFileMime = mime_content_type($_FILES["image"]["tmp_name"]);
					$imageFileSize = $_FILES["image"]["size"];
					
					//validation
					$imageFileAllowedMime = array("image/jpeg", "image/png", "image/gif");
					$imageFileMaxSize = 1 * 1024 * 1024;// 1 MB
					
					if (!in_array($imageFileMime, $imageFileAllowedMime)) {
						$formErrors["image"][] = "Slika sme biti samo u .png, .gif ili .jpeg formatu!!!";
					}
					
					if ($imageFileSize > $imageFileMaxSize) {
						$formErrors["image"][] = "Image max size can me 1MB. Please browse smaller image!!!";
					}
					
				} else {
					$formErrors["image"][] = "Sometning is wrong with file upload: " . $_FILES["image"]["error"] . "!!!";
				}
			  }
			  
			  
	 			//UKOLIKO NEMA GRESAKA PROVERA SLIKE
				if (empty($formErrors)) {
					//Uradi akciju koju je korisnik trazio
			        $image = NULL;
			        if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) { 
		                if (empty($_FILES["image"]["error"])) {
		                    $destinationPath = PUTANJA.'profesori/'. $imageFileName;	 
		                    	
			                if (!move_uploaded_file($imageFileTmpPath, $destinationPath)) {
			                    $formErrors["image"][] = "Nesto nije uredu sa snimanjem slike";
			                }else{
			                    $image = $imageFileName;   
			                }
		                }
			        }
			    } 
			    
			    //UKOLIKO NEMA GRESAKA
 			    if (empty($formErrors)){
 			  	//OVDE SNIMAMO PROFESORA AKO JE SVE USPESNO
 			  	  $data=array(
 			  	  'titula_srp'=>$formData["titula_srp"],
 			  	  'titula_eng'=>$formData["titula_eng"],
 			  	  'ime'=>$formData["ime"],
 			  	  'prezime'=>$formData["prezime"],
 			  	  'opis_srp'=>$formData["editor1"],
 			  	  'opis_eng'=>$formData["editor2"],
 			  	  );
 			  	  $snimi=$this->profesorModel->insertProfesora($data,$image);
 			  	  
 			  	  if (!$snimi){
 			  	  	$data=array(
 			  	  	'status'=>'Desila se greska prilikom snimanja profesora'
 			  	  	);
 			  	  	$this->view('admin/profesori/insert', $data);
 			  	  }else{
 			  	  	$profesori=$this->profesorModel->getProfesori();
			 		$data=array(
			 		'profesori'=>$profesori,
			 		'status'=>'Uspesno snimeljen profesor'
			 		);
			 		$this->view('admin/profesori/lista', $data);
 			  	  }
 			  	  
 			      
 			    }else{
 			    	
 			  	//OVDE HVATAMO GRESKE AKO IH IMA I FORMIRAMO NIZ $DATA=array();
 			  	$data=array();
 			    if(!empty($formErrors["titula_srp"])){
 			    	$data['titula_srp_error']=$formErrors["titula_srp"];
 			    	$data['titula_srp']=$formData["titula_srp"];
                }
 			    if(!empty($formErrors["titula_eng"])){
 			    	$data['titula_eng_error']=$formErrors["titula_eng"];
 			    	$data['titula_eng']=$formData["titula_eng"];
                }
 			    if(!empty($formErrors["ime"])){
 			    	$data['ime_error']=$formErrors["ime"];
 			    	$data['ime']=$formData["ime"];
                }
 			    if(!empty($formErrors["prezime"])){
 			    	$data['prezime_error']=$formErrors["prezime"];
 			    	$data['prezime']=$formData["prezime"];
                }
 			    if(!empty($formErrors["editor1"])){
 			    	$data['editor1_error']=$formErrors["editor1"];
 			    	$data['editor1']=$formData["editor1"];
                }
 			    if(!empty($formErrors["editor2"])){
 			    	$data['editor2_error']=$formErrors["editor2"];
 			    	$data['editor2']=$formData["editor2"];
                }
 			    if(!empty($formErrors["editor2"])){
 			    	$data['editor2_error']=$formErrors["editor2"];
 			    	$data['editor2']=$formData["editor2"];
                }
 			    if(!empty($formErrors["image"])){
 			    	$data['image_error']=$formErrors["image"];
                }
 			  	$this->view('admin/profesori/insert', $data);
 			  }

 			}else{
 				//OVO JE USLOV AKO NEKO POKUSA DA SABMITUJE FORMU SA NE VAZECIM VREDNOSTIMA
 				//VRACAMO GA SAMO NAZAD NA FORMU BEZ IKAKVE AKCIJE
 				$data=array(
 				'obavestenje'=>"Zlonameran pokusaj"
 				);
 			    $this->view('admin/profesori/insert', $data);
 			}
 		}else{
 			//OVO JE USLOV AKO SE SAMO KLIKNE NA LINK UNESI PROFESORA,SAMO NAS PROSLEDI NA STRANU ZA UNOS
 			$data=array();
 		    $this->view('admin/profesori/insert', $data);
 		}
 	  }    
 	}
 	
 	public function lista(){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
	 		$profesori=$this->profesorModel->getProfesori();
	 		$data=array(
	 		'profesori'=>$profesori
	 		);
	 		$this->view('admin/profesori/lista', $data);
 		}
 	} 
 	
 	public function showEdit($id){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
 		$idProfesora=$id;
 		$profesor=$this->profesorModel->profesorById($idProfesora);
 		if (!empty($profesor)){
 			$data=array(
 			'id'=>$profesor->id,
	 		'titula_srp'=>$profesor->titula_srp,
	 		'titula_eng'=>$profesor->titula_eng, 
	 		'ime'=>$profesor->ime,
	 		'prezime'=>$profesor->prezime,
	 		'editor1'=>$profesor->opis_srp,
	 		'editor2'=>$profesor->opis_eng,
	 		'slika'=>$profesor->slika
	 		);
 		    $this->view('admin/profesori/edit', $data);
 		}else{
 			
 			$data=array(
 			"greska"=>"Nije pronadjen profesor"
 			);
 			$this->view('admin/profesori/edit', $data);
 		}
 	  }
 	}
 	
 	public function edit(){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
 	        //ovde su default vrednosti za polja u formi
            $defaultFormData = array();
	        //ovde se smestaju greske koje imaju polja u formi
            $formErrors = array();
            //u promenljivu $formData stavljate $_GET ili $_POST u zavisnosti od forme
            $formData = $_POST; // $_GET ili $_POST 
            $id=$formData['id'];
 			if (isset($formData["click"]) && $formData["click"] == "Edit"){
 				
 			   /*********** filtriranje i validacija polja ****************/
               // TITULA SRPSKI
	           if (isset($formData["titula_srp"])) {
		           //Filtering 1
				   $formData["titula_srp"] = trim($formData["titula_srp"]);
		           $formData["titula_srp"] = strip_tags($formData["titula_srp"]);

			        //Validation - if required
			        if ($formData["titula_srp"] === "") {
				        $formErrors["titula_srp"][] = "Titula je obavezna!!!";
			        }else{
	                  if(mb_strlen($formData["titula_srp"])>20){
	                  	  $formErrors["titula_srp"][] = "Titula ne sme imati vise od 20 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["titula_srp"][] = "Titula mora biti prosledjena!!!";
	           }
 				
 			   /*********** filtriranje i validacija polja ****************/
               // TITULA ENGLESKI
	           if (isset($formData["titula_eng"])) {
		           //Filtering 1
				   $formData["titula_eng"] = trim($formData["titula_eng"]);
		           $formData["titula_eng"] = strip_tags($formData["titula_eng"]);

			        //Validation - if required
			        if ($formData["titula_eng"] === "") {
				        $formErrors["titula_eng"][] = "Titula je obavezna!!!";
			        }else{
	                  if(mb_strlen($formData["titula_eng"])>20){
	                  	  $formErrors["titula_eng"][] = "Titula ne sme imati vise od 20 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["titula_eng"][] = "Titula mora biti prosledjena!!!";
	           } 
	           
 			   /*********** filtriranje i validacija polja ****************/
               // IME
	           if (isset($formData["ime"])) {
		           //Filtering 1
				   $formData["ime"] = trim($formData["ime"]);
		           $formData["ime"] = strip_tags($formData["ime"]);

			        //Validation - if required
			        if ($formData["ime"] === "") {
				        $formErrors["ime"][] = "Ime je obavezno!!!";
			        }else{
	                  if(mb_strlen($formData["ime"])>20){
	                  	  $formErrors["ime"][] = "Ime ne sme imati vise od 20 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["ime"][] = "Ime mora biti prosledjeno!!!";
	           } 
	           
 			   /*********** filtriranje i validacija polja ****************/
               // PREZIME
	           if (isset($formData["prezime"])) {
		           //Filtering 1
				   $formData["prezime"] = trim($formData["prezime"]);
		           $formData["prezime"] = strip_tags($formData["prezime"]);

			        //Validation - if required
			        if ($formData["prezime"] === "") {
				        $formErrors["prezime"][] = "Prezime je obavezno!!!";
			        }else{
	                  if(mb_strlen($formData["prezime"])>20){
	                  	  $formErrors["prezime"][] = "Prezime ne sme imati vise od 20 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["prezime"][] = "Prezime mora biti prosledjeno!!!";
	           }
	           
 			   /*********** filtriranje i validacija polja ****************/
               // OPIS SRPSKI
			    if (isset($formData["editor1"])) {
					//Filtering 1
					$formData["editor1"] = trim($formData["editor1"]);
			        $formData["editor1"] = strip_tags($formData["editor1"], "<br><br/><h1></h1><h2></h2><h3></h3><p></p><em></em><strong></strong>");
			        if (mb_strlen($formData["editor1"])>65000){
			        	$formErrors["editor1"][] = "Opis ne sme imati vise od 65000 karaktera!!!";
			        }
				}
				
 			   /*********** filtriranje i validacija polja ****************/
               // OPIS ENGLESKI
			    if (isset($formData["editor2"])) {
					//Filtering 1
					$formData["editor2"] = trim($formData["editor2"]);
			        $formData["editor2"] = strip_tags($formData["editor2"], "<br><br/><h1></h1><h2></h2><h3></h3><p></p><em></em><strong></strong>");
			        if (mb_strlen($formData["editor2"])>65000){
			        	$formErrors["editor2"][] = "Opis ne sme imati vise od 65000 karaktera!!!";
			        }
				}
	           
 			  /*********** filtriranje i validacija polja ****************/
              // SLIKA
		      if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) {
				if (empty($_FILES["image"]["error"])) {
					//filtering
					$imageFileTmpPath = $_FILES["image"]["tmp_name"];
					$imageFileName = basename($_FILES["image"]["name"]);
					$imageFileMime = mime_content_type($_FILES["image"]["tmp_name"]);
					$imageFileSize = $_FILES["image"]["size"];
					
					//validation
					$imageFileAllowedMime = array("image/jpeg", "image/png", "image/gif");
					$imageFileMaxSize = 1 * 1024 * 1024;// 1 MB
					
					if (!in_array($imageFileMime, $imageFileAllowedMime)) {
						$formErrors["image"][] = "Slika sme biti samo u .png, .gif ili .jpeg formatu!!!";
					}
					
					if ($imageFileSize > $imageFileMaxSize) {
						$formErrors["image"][] = "Image max size can me 1MB. Please browse smaller image!!!";
					}
					
				} else {
					$formErrors["image"][] = "Sometning is wrong with file upload: " . $_FILES["image"]["error"] . "!!!";
				}
			  }
			  
	 			//UKOLIKO NEMA GRESAKA PROVERA SLIKE
				if (empty($formErrors)) {
					//Uradi akciju koju je korisnik trazio
			        if (isset($_FILES["image"]) && is_file($_FILES["image"]["tmp_name"])) { 
		                if (empty($_FILES["image"]["error"])) {
		                    $destinationPath = PUTANJA.'profesori/'. $imageFileName;	 
		                    	
			                if (!move_uploaded_file($imageFileTmpPath, $destinationPath)) {
			                    $formErrors["image"][] = "Nesto nije uredu sa snimanjem slike";
			                }else{
			                    $image = $imageFileName;   
			                }
		                }
			        }else{
			        	$image=$formData['profaslika'];
			        }
			    } 
			    
			    //UKOLIKO NEMA GRESAKA
 			    if (empty($formErrors)){
 			  	//OVDE SNIMAMO PROFESORA AKO JE SVE USPESNO
 			  	  $data=array(
 			  	  'titula_srp'=>$formData["titula_srp"],
 			  	  'titula_eng'=>$formData["titula_eng"],
 			  	  'ime'=>$formData["ime"],
 			  	  'prezime'=>$formData["prezime"],
 			  	  'opis_srp'=>$formData["editor1"],
 			  	  'opis_eng'=>$formData["editor2"],
 			  	  );
 			  	  $snimi=$this->profesorModel->editProfesora($data,$image,$id);
 			  	  
 			  	  if (!$snimi){
 			  	  	$data=array(
 			  	  	'status'=>'Desila se greska prilikom snimanja profesora'
 			  	  	);
 			  	  	$this->view('admin/profesori/edit', $data);
 			  	  }else{
 			  	  	$profesori=$this->profesorModel->getProfesori();
			 		$data=array(
			 		'profesori'=>$profesori,
			 		'status'=>'Uspesno snimeljen profesor'
			 		);
			 		$this->view('admin/profesori/lista', $data);
 			  	  }
 			    }else{
	 			    $idProfesora=$id;
	 			    $profesor=$this->profesorModel->profesorById($idProfesora);
	 			  	//OVDE HVATAMO GRESKE AKO IH IMA I FORMIRAMO NIZ $DATA=array();
	 			  	$data=array();
	 			    if(!empty($formErrors["titula_srp"])){
	 			    	$data['titula_srp_error']=$formErrors["titula_srp"];
	                }else{
	                	$data['titula_srp']=$profesor->titula_srp;
	                }
	 			    if(!empty($formErrors["titula_eng"])){
	 			    	$data['titula_eng_error']=$formErrors["titula_eng"];
	                }else{
	                	$data['titula_eng']=$profesor->titula_eng;
	                }
	 			    if(!empty($formErrors["ime"])){
	 			    	$data['ime_error']=$formErrors["ime"];
	                }else{
	                	$data['ime']=$profesor->ime;
	                }
	 			    if(!empty($formErrors["prezime"])){
	 			    	$data['prezime_error']=$formErrors["prezime"];
	                }else{
	                	$data['prezime']=$profesor->prezime;
	                }
	 			    if(!empty($formErrors["editor1"])){
	 			    	$data['editor1_error']=$formErrors["editor1"];
	                }else{
	                	$data['editor1']=$profesor->opis_srp;
	                }
	 			    if(!empty($formErrors["editor2"])){
	 			    	$data['editor2_error']=$formErrors["editor2"];
	                }else{
	                	$data['editor2']=$profesor->opis_eng;
	                }
	 			    
	 			    if(!empty($formErrors["image"])){
	 			    	$data['image_error']=$formErrors["image"];
	                }else{
	                	$data['slika']=$profesor->slika;
	                }
 			  	$this->view('admin/profesori/edit', $data);
 			  }

 			}else{
 				//OVO JE USLOV AKO NEKO POKUSA DA SABMITUJE FORMU SA NE VAZECIM VREDNOSTIMA
 				//VRACAMO GA SAMO NAZAD NA FORMU BEZ IKAKVE AKCIJE
 				$data=array(
 				'obavestenje'=>"Zlonameran pokusaj"
 				);
 			    $this->view('admin/profesori/edit', $data);
 			}
 		}
 	}
 	
 	public function delete($id){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
	 		$idProfesora=$id;
	 		$delete=$this->profesorModel->deleteProfesora($idProfesora);
	 		$profesori=$this->profesorModel->getProfesori();
	 		$data=array(
	 		'profesori'=>$profesori
	 		);
	 		$this->view('admin/profesori/lista', $data);
 	    }
 	}
 	
 }