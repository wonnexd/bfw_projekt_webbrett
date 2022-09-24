<?php
namespace classes\model;

class Anzeige{
	private $nummer;
	private $text;
	private $datum;
	private $inserent;

	public function __construct ($nummer = 0, $text = "", $datum = "", Inserent $inserent = null){
		$this->nummer = $nummer;
		$this->text = $text;
		$this->datum = $datum;
		$this->inserent = $inserent;
	}
	
	public function getNummer(){
		return $this->nummer;
	}
	
	public function setNummer($nummer){
		$this->nummer = $nummer;
	}
	
	public function getText(){
		return $this->text;
	}
	
	public function setText($text){
		$this->text  = $text;
	}
	
	public function getDatum(){
		return $this->datum;
	}
	
	public function setDatum($datum){
		$this->datum  = $datum;
	}
	
	public function getInserent(){
		return $this->inserent;
	}
	
	public function setInserent(Inserent $inserent){
		$this->inserent  = $inserent;
	}	
}