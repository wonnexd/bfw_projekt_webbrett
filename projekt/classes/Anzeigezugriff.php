<?php

class Anzeigezugriff {

    private $dbConnect;

    public function __construct() {
        $this->dbConnect = new mysqli('localhost', 'root', '', 'webbrett');
    }

    public function create($anzeigennummer, $inserentennummer, $titel, $autor, $verlag, $isbn, $anzeigendatum) {

        $sql = 'INSERT INTO anzeige (anzeigennummer , inserentennummer, titel, autor, verlag, isbn, anzeigendatum) VALUES (?, ?, ?, ?, ?, ?, ?)';

        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bind_param("iisssis", $anzeigennummer, $inserentennummer, $titel, $autor, $verlag, $isbn, $anzeigendatum);
        $stmt->execute();

        $id = $stmt->insert_id;

        $this->dbConnect->close();
        return $id;
    }

    public function read($bezeichnung) {
        $sql = "SELECT a.anzeigennummer, a.titel, a.autor, a.verlag, a.isbn, a.anzeigendatum, a.inserentennummer FROM anzeige a, veroeffentlichen v, rubrik r where a.anzeigennummer = v.anzeigennummer and r.rubriknummer = v.rubriknummer and r.rubrikbezeichnung = ?";
        $anzeigeList = array();

        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bind_param("s", $bezeichnung);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($obj = $result->fetch_object()) {
            $anzeigeList[] = new Anzeige($obj->anzeigennummer, $obj->titel, $obj->autor, $obj->verlag, $obj->isbn, $obj->anzeigendatum, $obj->inserentennummer);
        }

//        foreach ($rubrikList as $value) {
//            echo $value->getBezeichnung() . '</br>';
//            echo $value->getNummer() . '</br>';
//        }

        /* while($row = $resultData->fetch_array(MYSQLI_ASSOC)){
          $rubrikList[] = new Rubrik($row["rubriknummer"], $row["rubrikbezeichnung"]);
          } */
        $result->free();

        return $anzeigeList;
    }

    public function readAll() {
        $sql = "SELECT anzeigennummer, titel, anzeigendatum FROM anzeige ORDER BY anzeigendatum DESC";
        $anzeigeList = array();

        $resultData = $this->dbConnect->query($sql);

        while ($obj = $resultData->fetch_object()) {
            $anzeigeList[] = new Anzeige($obj->anzeigennummer, $obj->titel);
        }

//        foreach ($rubrikList as $value) {
//            echo $value->getBezeichnung() . '</br>';
//            echo $value->getNummer() . '</br>';
//        }

        /* while($row = $resultData->fetch_array(MYSQLI_ASSOC)){
          $rubrikList[] = new Rubrik($row["rubriknummer"], $row["rubrikbezeichnung"]);
          } */
        $resultData->free();

        return $anzeigeList;
    }

    public function insertInserent($alleInserenten, $alleAnzeigen) {
        foreach ($alleInserenten as $inserent) {
            $nummer1 = $inserent->getNummer();
            foreach ($alleAnzeigen as $anzeige) {
                $nummer2 = $anzeige->getInserentennummer();
                if ($nummer1 == $nummer2) {
                    $anzeige->setInserent($inserent);
                }
            }
        }
        return $alleAnzeigen;
    }

    public function update(Rubrik $rubrik) {

    }

    public function delete($nummer) {

    }

    public function __destruct() {
        //$this->dbConnect->close();
    }

}
