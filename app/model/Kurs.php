<?php
class Kurs{
	
	private $db;
	
	private $SELECT_ALL_FROM_KURSEVI="SELECT * FROM kurs"; 
	private $DELETE_KURSA="DELETE FROM kurs WHERE id=:id";
	private $INSERT_KURSA="INSERT INTO `kurs` (`duzina_trajanja_srp`, `duzina_trajanja_eng`, `naziv_srp`, `naziv_eng`, `opis_srp`,`opis_eng`) VALUES (:duzina_srp,:duzina_eng,:naziv_srp,:naziv_eng,:opis_srp,:opis_eng);";
	private $SELECT_KURS_BY_ID="SELECT * FROM `kurs` WHERE id=:id";
	private $EDIT_KURSA="UPDATE `kurs` SET `duzina_trajanja_srp` =:duzina_srp , `duzina_trajanja_eng` =:duzina_eng , `naziv_srp` =:naziv_srp, `naziv_eng` =:naziv_eng , `opis_srp` =:opis_srp ,opis_eng=:opis_eng  WHERE `kurs`.`id` =:id;";
	private $KURSEVI_FOR_SELECT="SELECT id, naziv_srp FROM kurs ORDER BY naziv_srp;";
	
	public function __construct(){
		$this->db=Database::createInstance();
	}
	
	public function insertKursa($data){
		$statement =$this->db->prepare($this->INSERT_KURSA);
		$statement->bindParam(':duzina_srp', $data['duzina_trajanja_srp']);
		$statement->bindParam(':duzina_eng', $data['duzina_trajanja_eng']);
		$statement->bindParam(':naziv_srp', $data['naziv_srp']);
		$statement->bindParam(':naziv_eng', $data['naziv_eng']);
		$statement->bindParam(':opis_srp', $data['opis_srp']);
		$statement->bindParam(':opis_eng', $data['opis_eng']);
		$status =$statement->execute();
		
		if ($status){
			return true;
		}else{
			return false;
		}
	}
	
	public function kursById($idKursa){
		$statement =$this->db->prepare($this->SELECT_KURS_BY_ID);
		$statement->bindParam(':id',$idKursa);
		$statement->execute();
		$result=$statement->fetch();
		return $result;
	}
	
	public function getKursevi(){
		$statement =$this->db->prepare($this->SELECT_ALL_FROM_KURSEVI);
		$statement->execute();
		$result=$statement->fetchAll();
		return $result;
	}
	
	public function editKursa($data,$id){
		$statement =$this->db->prepare($this->EDIT_KURSA);
		$statement->bindParam(':duzina_srp', $data['duzina_trajanja_srp']);
		$statement->bindParam(':duzina_eng', $data['duzina_trajanja_eng']);
		$statement->bindParam(':naziv_srp', $data['naziv_srp']);
		$statement->bindParam(':naziv_eng', $data['naziv_eng']);
		$statement->bindParam(':opis_srp', $data['opis_srp']);
		$statement->bindParam(':opis_eng', $data['opis_eng']);
		$statement->bindParam(':id', $id);
		$status =$statement->execute();
		
	    if ($status){
			return true;
		}else{
			return false;
		}
	}
	
    public function deleteKursa($idKursa){
		$statement =$this->db->prepare($this->DELETE_KURSA);
        $statement->bindParam(':id', $idKursa);
		$statement->execute();
	}
	
    public function getKurseviForSelect(){
		$statement =$this->db->prepare($this->KURSEVI_FOR_SELECT);
		$status=$statement->execute();
		if ($status){
			$rows=$statement->fetchAll();
			// prepare possible values
            $arrayForSelectOption = array();
            if(count($rows) > 0){
                foreach ($rows as $value) {
                    $arrayForSelectOption[$value->id] = $value->naziv_srp;
                }
            }
            
			return $arrayForSelectOption;
		}else{
			return array();
		}
	}
}

?>