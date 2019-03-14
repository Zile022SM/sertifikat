<?php
class Profesor{
	
	private $db;
	
	private $SELECT_ALL_FROM_PROFESORI="SELECT * FROM profesori"; 
	private $DELETE_PROFESORA="DELETE FROM profesori WHERE id=:id";
	private $INSERT_PROFESOR="INSERT INTO `profesori` (`titula_srp`, `titula_eng`, `ime`, `prezime`, `opis_srp`, `opis_eng`, `slika`) VALUES (:titula_srp,:titula_eng,:ime,:prezime,:opis_srp,:opis_eng,:slika);";
	private $SELECT_PROFESOR_BY_ID="SELECT * FROM `profesori` WHERE id=:id";
	private $EDIT_PROFESOR="UPDATE `profesori` SET `titula_srp` =:titula_srp , `titula_eng` =:titula_eng , `ime` =:ime, `prezime` =:prezime , `opis_srp` =:opis_srp , `opis_eng` =:opis_eng,`slika`=:slika  WHERE `profesori`.`id` =:id;";
	private $PROFESORI_FOR_SELECT="SELECT id, ime FROM profesori ORDER BY ime;";
	
	public function __construct(){
		$this->db=Database::createInstance();
	}
	
	public function insertProfesora($data,$image){
		$statement =$this->db->prepare($this->INSERT_PROFESOR);
		$statement->bindParam(':titula_srp', $data['titula_srp']);
		$statement->bindParam(':titula_eng', $data['titula_eng']);
		$statement->bindParam(':ime', $data['ime']);
		$statement->bindParam(':prezime', $data['prezime']);
		$statement->bindParam(':opis_srp', $data['opis_srp']);
		$statement->bindParam(':opis_eng', $data['opis_eng']);
		$statement->bindParam(':slika', $image);
		$status =$statement->execute();
		
		if ($status){
			return true;
		}else{
			return false;
		}
	}
	
	public function profesorById($idProfesora){
		$statement =$this->db->prepare($this->SELECT_PROFESOR_BY_ID);
		$statement->bindParam(':id',$idProfesora);
		$statement->execute();
		$result=$statement->fetch();
		return $result;
	}
	
	public function getProfesori(){
		$statement =$this->db->prepare($this->SELECT_ALL_FROM_PROFESORI);
		$statement->execute();
		$result=$statement->fetchAll();
		return $result;
	}
	
	public function editProfesora($data,$image,$id){
		$statement =$this->db->prepare($this->EDIT_PROFESOR);
		$statement->bindParam(':titula_srp', $data['titula_srp']);
		$statement->bindParam(':titula_eng', $data['titula_eng']);
		$statement->bindParam(':ime', $data['ime']);
		$statement->bindParam(':prezime', $data['prezime']);
		$statement->bindParam(':opis_srp', $data['opis_srp']);
		$statement->bindParam(':opis_eng', $data['opis_eng']);
		$statement->bindParam(':slika', $image);
		$statement->bindParam(':id', $id);
		$status =$statement->execute();
		
	    if ($status){
			return true;
		}else{
			return false;
		}
	}
	
    public function deleteProfesora($idProfesora){
		$statement =$this->db->prepare($this->DELETE_PROFESORA);
        $statement->bindParam(':id', $idProfesora);
		$statement->execute();
	}
	
    public function getProfesoriForSelect(){
		$statement =$this->db->prepare($this->PROFESORI_FOR_SELECT);
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