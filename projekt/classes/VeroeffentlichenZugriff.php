<?php

class VeroeffentlichenZugriff {

    private $dbConnect;

    public function __construct() {
        $this->dbConnect = new mysqli('localhost', 'root', '', 'webbrett');
    }

    public function createVeroeffentlichen($anzeigennummer, $rubriknummer) {

        $sql = 'INSERT INTO veroeffentlichen (anzeigennummer , rubriknummer) VALUES (?, ?)';

        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bind_param("ii", $anzeigennummer, $rubriknummer);
        $stmt->execute();
    }

}
