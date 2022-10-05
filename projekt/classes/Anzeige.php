<?php

class Anzeige {

    private $nummer;
    private $titel;
    private $autor;
    private $verlag;
    private $isbn;
    private $datum;
    private $inserent;
    private $inserentennummer;

    public function __construct($nummer = 0, $titel = "", $autor = "", $verlag = "", $isbn = null, $datum = "", $inserentennummer = "", $inserent = null) {
        $this->nummer = $nummer;
        $this->titel = $titel;
        $this->autor = $autor;
        $this->verlag = $verlag;
        $this->isbn = $isbn;
        $this->datum = $datum;
        $this->inserentennummer = $inserentennummer;
        $this->inserent = $inserent;
    }

    public function getNummer() {
        return $this->nummer;
    }

    public function setNummer($nummer) {
        if ($this->hilfsfunktion($nummer)) {
            $this->nummer = $nummer;
        }
    }

    private function hilfsfunktion($zahl) {
        if (is_numeric($zahl) && $zahl > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getTitel() {
        return $this->titel;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getVerlag() {
        return $this->verlag;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getInserent() {
        return $this->inserent;
    }

    public function getInserentennummer() {
        return $this->inserentennummer;
    }

    public function setTitel($titel): void {
        $this->titel = $titel;
    }

    public function setAutor($autor): void {
        $this->autor = $autor;
    }

    public function setVerlag($verlag): void {
        $this->verlag = $verlag;
    }

    public function setIsbn($isbn): void {
        $this->isbn = $isbn;
    }

    public function setInserent($inserent): void {
        $this->inserent = $inserent;
    }

    public function setInserentennummer($inserentennummer): void {
        $this->inserentennummer = $inserentennummer;
    }

    public function __toString() {
        return $this->nummer . $this->titel . $this->datum . $this->inserentennummer . $this->inserent;
    }

}
