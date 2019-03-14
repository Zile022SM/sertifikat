<?php
class Polaznici extends Controller{
 	public function __construct(){
 		$this->polaznikModel=$this->model('Polaznik');
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
               // IME
	           if (isset($formData["ime"])) {
		           //Filtering 1
				   $formData["ime"] = trim($formData["ime"]);
		           $formData["ime"] = strip_tags($formData["ime"]);

			        //Validation - if required
			        if ($formData["ime"] === "") {
				        $formErrors["ime"][] = "Ime je obavezno!!!";
			        }else{
	                  if(mb_strlen($formData["ime"])>100){
	                  	  $formErrors["ime"][] = "Ime ne sme imati vise od 100 karaktera!!!";
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
	                  if(mb_strlen($formData["prezime"])>100){
	                  	  $formErrors["prezime"][] = "Titula ne sme imati vise od 100 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["prezime"][] = "Prezime mora biti prosledjeno!!!";
	           } 
	           
 			   /*********** filtriranje i validacija polja ****************/
               // BROJ TELEFONA
	           if (isset($formData["broj"])) {
		           //Filtering 1
				   $formData["broj"] = trim($formData["broj"]);
		           $formData["broj"] = strip_tags($formData["broj"]);

			        //Validation - if required
			        if ($formData["broj"] === "") {
				        $formErrors["broj"][] = "Broj je obavezan!!!";
			        }else{
	                  if(mb_strlen($formData["broj"])>20){
	                  	  $formErrors["broj"][] = "Broj ne sme imati vise od 20 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["broj"][] = "Broj mora biti prosledjen!!!";
	           } 
	           
 			   /*********** filtriranje i validacija polja ****************/
               // EMAIL
	           if (isset($formData["email"])) {
		           //Filtering 1
				   $formData["email"] = trim($formData["email"]);
		           $formData["email"] = strip_tags($formData["email"]);

			        //Validation - if required
			        if ($formData["email"] === "") {
				        $formErrors["email"][] = "Email je obavezan!!!";
			        }else{
			             if (!filter_var($formData["email"], FILTER_VALIDATE_EMAIL)) {
  						   $formErrors["email"][] = "Neisprevan email format";
						 }
	                }
	           } else {
                     //if required
		             $formErrors["email"][] = "Prezime mora biti prosledjeno!!!";
	           }
	           
 			   /*********** filtriranje i validacija polja ****************/
               // DATUM
	           if (isset($formData["datum"])) {
		           //Filtering 1
				   //$formData["datum"] = trim($formData["datum"]);
		            //$formData["datum"] = strip_tags($formData["datum"]);

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
 			  	  'ime'=>$formData["ime"],
 			  	  'prezime'=>$formData["prezime"],
 			  	  'broj'=>$formData["broj"],
 			  	  'email'=>$formData["email"],
 			  	  'datum'=>$formData["datum"],
 			  	  );
 			  	  $snimi=$this->polaznikModel->insertPolaznika($data);
 			  	  
 			  	  if (!$snimi){
 			  	  	$data=array(
 			  	  	'status'=>'Desila se greska prilikom snimanja profesora'
 			  	  	);
 			  	  	$this->view('admin/polaznici/insert', $data);
 			  	  }else{
 			  	  	$polaznici=$this->polaznikModel->getPolaznici();
			 		$data=array(
			 		'polaznici'=>$polaznici,
			 		'status'=>'Uspesno snimeljen polaznik'
			 		);
			 		$this->view('admin/polaznici/lista', $data);
 			  	  }
 			  	  
 			    }else{
 			    	
 			  	//OVDE HVATAMO GRESKE AKO IH IMA I FORMIRAMO NIZ $DATA=array();
 			  	$data=array();
 			    if(!empty($formErrors["ime"])){
 			    	$data['ime_error']=$formErrors["ime"];
 			    	$data['ime']=$formData["ime"];
                }
 			    if(!empty($formErrors["prezime"])){
 			    	$data['prezime_error']=$formErrors["prezime"];
 			    	$data['prezime']=$formData["prezime"];
                }
 			    if(!empty($formErrors["broj"])){
 			    	$data['broj_error']=$formErrors["broj"];
 			    	$data['broj']=$formData["broj"];
                }
 			    if(!empty($formErrors["email"])){
 			    	$data['email_error']=$formErrors["email"];
 			    	$data['email']=$formData["email"];
                }
 			    if(!empty($formErrors["datum"])){
 			    	$data['datum_error']=$formErrors["datum"];
                }else{
                	$data['datum']=$formData["datum"];
                }
                
 			  	$this->view('admin/polaznici/insert', $data);
 			  }

 			}else{
 				//OVO JE USLOV AKO NEKO POKUSA DA SABMITUJE FORMU SA NE VAZECIM VREDNOSTIMA
 				//VRACAMO GA SAMO NAZAD NA FORMU BEZ IKAKVE AKCIJE
 				$data=array(
 				'obavestenje'=>"Zlonameran pokusaj"
 				);
 			    $this->view('admin/polaznici/insert', $data);
 			}
 		}else{
 			//OVO JE USLOV AKO SE SAMO KLIKNE NA LINK UNESI POLAZNIKA,SAMO NAS PROSLEDI NA STRANU ZA UNOS
 			$data=array();
 		    $this->view('admin/polaznici/insert', $data);
 		}
 	  }    
 	}
  
    public function lista(){
    	if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
	 		$polaznici=$this->polaznikModel->getPolaznici();
	 		$data=array(
	 		'polaznici'=>$polaznici
	 		);
	 		$this->view('admin/polaznici/lista', $data);
 		}
 	}
 	
    public function showEdit($id){
    	if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
 		$idPolaznika=$id;
 		$polaznik=$this->polaznikModel->polaznikById($idPolaznika);
 		if (!empty($polaznik)){
 			$data=array(
 			'id'=>$polaznik->id,
	 		'ime'=>$polaznik->ime,
	 		'prezime'=>$polaznik->prezime,
	 		'broj_telefona'=>$polaznik->broj_telefona,
	 		'email'=>$polaznik->email,
	 		'datum_rodjenja'=>$polaznik->datum_rodjenja
	 		);
 		    $this->view('admin/polaznici/edit', $data);
 		}else{
 			
 			$data=array(
 			"greska"=>"Nije pronadjen polaznik"
 			);
 			$this->view('admin/polaznici/edit', $data);
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
               // IME
	           if (isset($formData["ime"])) {
		           //Filtering 1
				   $formData["ime"] = trim($formData["ime"]);
		           $formData["ime"] = strip_tags($formData["ime"]);

			        //Validation - if required
			        if ($formData["ime"] === "") {
				        $formErrors["ime"][] = "Ime je obavezno!!!";
			        }else{
	                  if(mb_strlen($formData["ime"])>100){
	                  	  $formErrors["ime"][] = "Ime ne sme imati vise od 100 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["ime"][] = "Ime mora biti prosledjena!!!";
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
	                  if(mb_strlen($formData["prezime"])>100){
	                  	  $formErrors["prezime"][] = "Prezime ne sme imati vise od 100 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["prezime"][] = "Prezime mora biti prosledjeno!!!";
	           } 
	           
 			   /*********** filtriranje i validacija polja ****************/
               // BROJ TELEFONA
	           if (isset($formData["broj"])) {
		           //Filtering 1
				   $formData["broj"] = trim($formData["broj"]);
		           $formData["broj"] = strip_tags($formData["broj"]);

			        //Validation - if required
			        if ($formData["broj"] === "") {
				        $formErrors["broj"][] = "Broj je obavezan!!!";
			        }else{
	                  if(mb_strlen($formData["broj"])>20){
	                  	  $formErrors["broj"][] = "Broj ne sme imati vise od 20 karaktera!!!";
	                  }
	                }
	           } else {
                     //if required
		             $formErrors["broj"][] = "Broj mora biti prosledjen!!!";
	           } 
	           
 			   /*********** filtriranje i validacija polja ****************/
               // EMAIL
	           if (isset($formData["email"])) {
		           //Filtering 1
				   $formData["email"] = trim($formData["email"]);
		           $formData["email"] = strip_tags($formData["email"]);

			        //Validation - if required
			        if ($formData["email"] === "") {
				        $formErrors["email"][] = "Email je obavezan!!!";
			        }else{
			             if (!filter_var($formData["email"], FILTER_VALIDATE_EMAIL)) {
  						   $formErrors["email"][] = "Neisprevan email format";
						 }
	                }
	           } else {
                     //if required
		             $formErrors["email"][] = "Prezime mora biti prosledjeno!!!";
	           }
	           
 			   /*********** filtriranje i validacija polja ****************/
               // DATUM
	           if (isset($formData["datum"])) {
		           //Filtering 1
				   //$formData["datum"] = trim($formData["datum"]);
		            //$formData["datum"] = strip_tags($formData["datum"]);

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
 			  	  'ime'=>$formData["ime"],
 			  	  'prezime'=>$formData["prezime"],
 			  	  'broj_telefona'=>$formData["broj"],
 			  	  'email'=>$formData["email"],
 			  	  'datum_rodjenja'=>$formData["datum"],
 			  	  );
 			  	  $snimi=$this->polaznikModel->editPolaznika($data,$id);
 			  	  
 			  	  if (!$snimi){
 			  	  	$data=array(
 			  	  	'status'=>'Desila se greska prilikom snimanja polaznika'
 			  	  	);
 			  	  	$this->view('admin/polaznici/edit', $data);
 			  	  }else{
 			  	  	$polaznici=$this->polaznikModel->getPolaznici();
			 		$data=array(
			 		'polaznici'=>$polaznici,
			 		'status'=>'Uspesno snimeljen polaznik'
			 		);
			 		$this->view('admin/polaznici/lista', $data);
 			  	  }
 			    }else{
	 			    $idPolaznika=$id;
 		            $polaznik=$this->polaznikModel->polaznikById($idPolaznika);
	 			  	//OVDE HVATAMO GRESKE AKO IH IMA I FORMIRAMO NIZ $DATA=array();
	 			  	$data=array();
	 			    if(!empty($formErrors["ime"])){
	 			    	$data['ime_error']=$formErrors["ime"];
	                }else{
	                	$data['ime']=$polaznik->ime;
	                }
	 			    if(!empty($formErrors["prezime"])){
	 			    	$data['prezime_error']=$formErrors["prezime"];
	                }else{
	                	$data['prezime']=$polaznik->prezime;
	                }
	 			    if(!empty($formErrors["broj"])){
	 			    	$data['broj_error']=$formErrors["broj"];
	                }else{
	                	$data['broj_telefona']=$polaznik->broj_telefona;
	                }
	 			    if(!empty($formErrors["email"])){
	 			    	$data['email_error']=$formErrors["email"];
	                }else{
	                	$data['email']=$polaznik->email;
	                }
	 			    if(!empty($formErrors["datum"])){
	 			    	$data['datum_error']=$formErrors["datum"];
	                }else{
	                	$data['datum_rodjenja']=$polaznik->datum_rodjenja;
	                }
 			  	    $this->view('admin/polaznici/edit', $data);
 			  }

 			}else{
 				//OVO JE USLOV AKO NEKO POKUSA DA SABMITUJE FORMU SA NE VAZECIM VREDNOSTIMA
 				//VRACAMO GA SAMO NAZAD NA FORMU BEZ IKAKVE AKCIJE
 				$data=array(
 				'obavestenje'=>"Zlonameran pokusaj"
 				);
 			    $this->view('admin/polaznici/edit', $data);
 			}
 		}
 	}
 	
 	
 	public function delete($id){
 		if (!isLoggedIn()){
 			$this->view('admin/users/login');
 		}else{
	 		$idPolaznika=$id;
	 		$delete=$this->polaznikModel->deletePolaznika($idPolaznika);
	 		$polaznici=$this->polaznikModel->getPolaznici();
	 		$data=array(
	 		'polaznici'=>$polaznici
	 		);
	 		$this->view('admin/polaznici/lista', $data);
 		}
 	}	
 	
 }