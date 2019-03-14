<?php
class Diploma{
	
	private $db;
	
	private $SELECT_ALL_FROM_SERTIFIKATI="SELECT sertifikati.id,polaznik.ime as ime,polaznik.prezime as prezime,kurs.naziv_srp as naziv,broj_sertifikata as broj,datum_dobijanja as datum FROM `sertifikati`
										  JOIN polaznik ON sertifikati.polaznik_id=polaznik.id 
										  JOIN kurs ON sertifikati.kurs_id=kurs.id";
	private $DELETE_SERTIFIKATA="DELETE FROM sertifikati WHERE id=:id";
	private $INSERT_SERTIFIKATA="INSERT INTO `sertifikati` (`polaznik_id`, `kurs_id`, `broj_sertifikata`, `datum_dobijanja`) VALUES (:polaznik_id,:kurs_id,:broj_sertifikata,:datum_dobijanja);";
	private $SELECT_SERTIFIKAT_BY_ID="SELECT * FROM `kurs` WHERE id=:id";
	private $PROVERA_BROJA_SERTIFIKATA="SELECT broj_sertifikata as broj FROM `sertifikati` ORDER BY id DESC LIMIT 1";
	
	public function __construct(){
		$this->db=Database::createInstance();
	}
	
	public function insertSertifikata($data){
		$statement =$this->db->prepare($this->INSERT_SERTIFIKATA);
		$statement->bindParam(':polaznik_id', $data['polaznik_id']);
		$statement->bindParam(':kurs_id', $data['kurs_id']);
		$statement->bindParam(':broj_sertifikata', $data['broj_sertifikata']);
		$statement->bindParam(':datum_dobijanja', $data['datum_dobijanja']);
		$status =$statement->execute();
		
		if ($status){
			return true;
		}else{
			return false;
		}
	}
	
	public function sertifikatById($idKursa){
		$statement =$this->db->prepare($this->SELECT_KURS_BY_ID);
		$statement->bindParam(':id',$idKursa);
		$statement->execute();
		$result=$statement->fetch();
		return $result;
	}
	
	public function getSertifikati(){
		$statement =$this->db->prepare($this->SELECT_ALL_FROM_SERTIFIKATI);
		$statement->execute();
		$result=$statement->fetchAll();
		return $result;
	}
	
	
    public function deleteSertifikata($idSertifikata){
		$statement =$this->db->prepare($this->DELETE_SERTIFIKATA);
        $statement->bindParam(':id', $idSertifikata);
		$statement->execute();
	}
	
    public function proveraBroja(){
		$statement =$this->db->prepare($this->PROVERA_BROJA_SERTIFIKATA);
		$statement->execute();
		$result=$statement->fetch();
		return $result;
	}
}

?>