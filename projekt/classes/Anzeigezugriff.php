<?php

//include 'Rubrik.php';
//
//use classes\Rubrik;

class Anzeigezugriff {

    private $dbConnect;

    public function __construct() {
        $this->dbConnect = new mysqli('localhost', 'root', '', 'webbrett');
    }

    public function create($bezeichnung) {
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

    public function read($bezeichnung) {
        $sql = "SELECT a.anzeigennummer, a.anzeigentext, a.anzeigendatum, a.inserentennummer FROM anzeige a, veroeffentlichen v, rubrik r where a.anzeigennummer = v.anzeigennummer and r.rubriknummer = v.rubriknummer and r.rubrikbezeichnung = ?";
        $anzeigeList = array();

        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bind_param("s", $bezeichnung);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($obj = $result->fetch_object()) {
            $anzeigeList[] = new Anzeige($obj->anzeigennummer, $obj->anzeigentext, $obj->anzeigendatum, $obj->inserentennummer);
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
        $sql = "SELECT anzeigennummer, anzeigentext " .
                "FROM anzeige";
        $anzeigeList = array();

        $resultData = $this->dbConnect->query($sql);

        while ($obj = $resultData->fetch_object()) {
            $anzeigeList[] = new Anzeige($obj->anzeigennummer, $obj->anzeigentext);
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

    public function insertInserent($anzeige) {
        $inserentennummer = $anzeige->getInserentennummer();
        $sql = "SELECT i.inserentennummer, i.nickname, i.email FROM inserent i where i.inserentennummer = ?";

        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bind_param("i", $inserentennummer);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($obj = $result->fetch_object()) {
            $newInserent = new Inserent($obj->inserentennummer, $obj->nickname, $obj->email);
            $anzeige->setInserentennummer($newInserent);
        }

        return $anzeige;
    }

    public function update(Rubrik $rubrik) {

    }

    public function delete($nummer) {

    }

    public function __destruct() {
        //$this->dbConnect->close();
    }

}
