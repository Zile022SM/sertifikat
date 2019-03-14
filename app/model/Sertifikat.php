<?php
class Sertifikat{
	
	private $db;
	
	private $SELECT_ALL_FROM_SERTIFIKATI_BY_NUMBER="SELECT kurs.*,polaznik.*,sertifikati.* FROM sertifikati 
	JOIN kurs ON kurs.id=sertifikati.kurs_id 
	JOIN polaznik ON polaznik.id=sertifikati.polaznik_id 
	WHERE broj_sertifikata=:broj"; 
	
	private $SELECT_PROFESORS="SELECT ime,prezime,id_predavaca,titula_srp,titula_eng,slika FROM `kurs_predavac` JOIN kurs ON kurs_predavac.id_kursa=kurs.id 
    JOIN profesori ON kurs_predavac.id_predavaca=profesori.id WHERE id_kursa=:id";
	
	private $SELECT_PROFESOR_BY_ID="SELECT * FROM `profesori` WHERE id=:id";
	
	public function __construct(){
		$this->db=Database::createInstance();
	}
	
	public function rezultat($data){
		$statement =$this->db->prepare($this->SELECT_ALL_FROM_SERTIFIKATI_BY_NUMBER);
        $statement->bindParam(':broj', $data);
		$statement->execute();
		
		$result=$statement->fetch();
		return $result;
	}
	
	public function profesori($idKursa){
		$statement =$this->db->prepare($this->SELECT_PROFESORS);
		$statement->bindParam(':id', $idKursa);
		$statement->execute();
		
		$result=$statement->fetchAll();
		return $result;
	}
	
	public function profesorById($id){
		$statement =$this->db->prepare($this->SELECT_PROFESOR_BY_ID);
        $statement->bindParam(':id', $id);
		$statement->execute();
		
		$result=$statement->fetch();
		return $result;
	}
}