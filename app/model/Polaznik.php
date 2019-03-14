<?php
class Polaznik{
	
	private $db;
	
	private $SELECT_ALL_FROM_POLAZNICI="SELECT * FROM polaznik"; 
	private $DELETE_POLAZNIKA="DELETE FROM polaznik WHERE id=:id";
	private $INSERT_POLAZNIKA="INSERT INTO `polaznik` (`ime`, `prezime`, `broj_telefona`, `email`, `datum_rodjenja`) VALUES (:ime,:prezime,:broj,:email,:datum);";
	private $SELECT_POLAZNIK_BY_ID="SELECT * FROM `polaznik` WHERE id=:id";
	private $EDIT_POLAZNIK="UPDATE `polaznik` SET `ime` =:ime , `prezime` =:prezime , `broj_telefona` =:broj, `email` =:email , `datum_rodjenja` =:datum  WHERE `polaznik`.`id` =:id;";
	private $POLAZNICI_FOR_SELECT="SELECT id, ime FROM polaznik ORDER BY ime;";
	
	
	public function __construct(){
		$this->db=Database::createInstance();
	}
	
	public function insertPolaznika($data){
		$statement =$this->db->prepare($this->INSERT_POLAZNIKA);
		$statement->bindParam(':ime', $data['ime']);
		$statement->bindParam(':prezime', $data['prezime']);
		$statement->bindParam(':broj', $data['broj']);
		$statement->bindParam(':email', $data['email']);
		$statement->bindParam(':datum', $data['datum']);
		$status =$statement->execute();
		
		if ($status){
			return true;
		}else{
			return false;
		}
	}
	
	public function polaznikById($idPolaznika){
		$statement =$this->db->prepare($this->SELECT_POLAZNIK_BY_ID);
		$statement->bindParam(':id',$idPolaznika);
		$statement->execute();
		$result=$statement->fetch();
		return $result;
	}
	
	public function getPolaznici(){
		$statement =$this->db->prepare($this->SELECT_ALL_FROM_POLAZNICI);
		$statement->execute();
		$result=$statement->fetchAll();
		return $result;
	}
	
	public function editPolaznika($data,$id){
		$statement =$this->db->prepare($this->EDIT_POLAZNIK);
		$statement->bindParam(':ime', $data['ime']);
		$statement->bindParam(':prezime', $data['prezime']);
		$statement->bindParam(':broj', $data['broj_telefona']);
		$statement->bindParam(':email', $data['email']);
		$statement->bindParam(':datum', $data['datum_rodjenja']);
		$statement->bindParam(':id', $id);
		$status =$statement->execute();
		
	    if ($status){
			return true;
		}else{
			return false;
		}
	}
	
    public function deletePolaznika($idPolaznika){
		$statement =$this->db->prepare($this->DELETE_POLAZNIKA);
        $statement->bindParam(':id', $idPolaznika);
		$statement->execute();
	}
	
	public function getPolazniciForSelect(){
		$statement =$this->db->prepare($this->POLAZNICI_FOR_SELECT);
		$status=$statement->execute();
		if ($status){
			$rows=$statement->fetchAll();
			// prepare possible values
            $arrayForSelectOption = array();
            if(count($rows) > 0){
                foreach ($rows as $value) {
                    $arrayForSelectOption[$value->id] = $value->ime;
                }
            }
            
			return $arrayForSelectOption;
		}else{
			return array();
		}
	}
}

?>