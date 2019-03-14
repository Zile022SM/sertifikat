<?php
class Raspored{
	
	private $db;
	
	private $SELECT_ALL_FROM_RASPORED="SELECT kurs_predavac.id,profesori.ime as ime,profesori.prezime as prezime,kurs.naziv_srp as naziv,datum_pocetka as pocetak,datum_zavrsetka as zavrsetak FROM `kurs_predavac`
                                       JOIN profesori ON kurs_predavac.id_predavaca=profesori.id 
                                       JOIN kurs ON kurs_predavac.id_kursa=kurs.id";
	private $DELETE_RASPOREDA="DELETE FROM kurs_predavac WHERE id=:id";
	private $INSERT_RASPOREDA="INSERT INTO `kurs_predavac` (`id_kursa`, `id_predavaca`, `datum_pocetka`, `datum_zavrsetka`) VALUES (:id_kursa,:id_profesora,:datum_pocetka,:datum_zavrsetka);";
	private $SELECT_RASPORED_BY_ID="SELECT * FROM `kurs_predavac` WHERE kurs_predavac.id=:id";
	private $EDIT_RASPOREDA="UPDATE `kurs_predavac` SET `id_kursa` =:id_kursa, `id_predavaca` =:id_predavaca, `datum_pocetka` =:datum_pocetka, `datum_zavrsetka` =:datum_zavrsetka  WHERE `kurs_predavac`.`id` =:id;";
	
	public function __construct(){
		$this->db=Database::createInstance();
	}
	
	public function insertRasporeda($data){
		$statement =$this->db->prepare($this->INSERT_RASPOREDA);
		$statement->bindParam(':id_kursa', $data['id_kursa']);
		$statement->bindParam(':id_profesora', $data['id_profesora']);
		$statement->bindParam(':datum_pocetka', $data['datum_pocetka']);
		$statement->bindParam(':datum_zavrsetka', $data['datum_zavrsetka']);
		$status =$statement->execute();
		
		if ($status){
			return true;
		}else{
			return false;
		}
	}
	
	public function rasporedById($idKursaiPredavaca){
		$statement =$this->db->prepare($this->SELECT_RASPORED_BY_ID);
		$statement->bindParam(':id',$idKursaiPredavaca);
		$statement->execute();
		$result=$statement->fetch();
		return $result;
	}
	
	public function getRasporedi(){
		$statement =$this->db->prepare($this->SELECT_ALL_FROM_RASPORED);
		$statement->execute();
		$result=$statement->fetchAll();
		return $result;
	}
	
    public function editRasporeda($data){
		$statement =$this->db->prepare($this->EDIT_RASPOREDA);
		$statement->bindParam(':id_kursa', $data['id_kursa']);
		$statement->bindParam(':id_predavaca', $data['id_predavaca']);
		$statement->bindParam(':datum_pocetka', $data['pocetak']);
		$statement->bindParam(':datum_zavrsetka', $data['zavrsetak']);
		$statement->bindParam(':id', $data['id']);
		$status =$statement->execute();
		
	    if ($status){
			return true;
		}else{
			return false;
		}
	}
	
    public function deleteRasporeda($idRasporeda){
		$statement =$this->db->prepare($this->DELETE_RASPOREDA);
        $statement->bindParam(':id', $idRasporeda);
		$statement->execute();
	}
}

?>