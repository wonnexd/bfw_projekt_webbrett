<?php
namespace classes\mapper;
use classes\model\Rubrik;

class RubrikDAO{
	private $dbConnect;

	public function __construct (){
		$this->dbConnect = MySQLDatabase::getInstance();
	}
		
	public function create($bezeichnung){
		$id = -1;
		$bezeichnung = $this->dbConnect->real_escape_string($bezeichnung);
		$sql = "insert into rubrik (rubrikbezeichnung) values(?)";
		$preStmt = $this->dbConnect->prepare($sql);
		$preStmt->bind_param("s", $bezeichnung);
		$preStmt->execute();
	
		$id = $preStmt->insert_id;
		
		$preStmt->close();
		return $id;
	}
	
	public function read($nummer){
		$sql = "SELECT rubriknummer, rubrikbezeichnung " .
			   "FROM rubrik " .
			   "WHERE rubriknummer=?";
		$rubrik = null;

		$preStmt = $this->dbConnect->prepare($sql);
		$preStmt->bind_param("i", $nummer);
		$preStmt->execute();
		$preStmt->bind_result($nummer, $name);

		if($preStmt->fetch()){
			$rubrik = new Rubrik($nummer, $name);
		}
		$preStmt->free_result();
		$preStmt->close();

		return $rubrik;
	}
	
	public function readAll(){
		$sql = "SELECT rubriknummer, rubrikbezeichnung " .
			   "FROM rubrik";
		$rubrikList = array();
		
		$resultData = $this->dbConnect->query($sql);

		while($obj = $resultData->fetch_object()){
			$rubrikList[] = new Rubrik($obj->rubriknummer, $obj->rubrikbezeichnung);
		}
		
		/* while($row = $resultData->fetch_array(MYSQLI_ASSOC)){
			$rubrikList[] = new Rubrik($row["rubriknummer"], $row["rubrikbezeichnung"]);
		} */
		$resultData->free();
		
		return $rubrikList;
	}
	
	public function update(Rubrik $rubrik){
		
	}
	
	public function delete($nummer){
		
	}
	
	public function __destruct (){
		//$this->dbConnect->close();
	}
	
}