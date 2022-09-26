<?php

//include 'Rubrik.php';
//
//use classes\Rubrik;

class Rubrikzugriff {

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
        $sql = "SELECT i.inserentennummer, i.nickname FROM anzeige a, inserent i where a.inserentennummer = i.inserentennummer and a.rubrikbezeichnung = ?";
        $inserentenList = array();

        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bind_param("s", $bezeichnung);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($obj = $result->fetch_object()) {
            $inserentenList[] = new Anzeige($obj->inserentennummer, $obj->nickname);
        }

//        foreach ($rubrikList as $value) {
//            echo $value->getBezeichnung() . '</br>';
//            echo $value->getNummer() . '</br>';
//        }

        /* while($row = $resultData->fetch_array(MYSQLI_ASSOC)){
          $rubrikList[] = new Rubrik($row["rubriknummer"], $row["rubrikbezeichnung"]);
          } */
        $result->free();

        return $inserentenList;
    }

    public function readAll() {
        $sql = "SELECT rubriknummer, rubrikbezeichnung " .
                "FROM rubrik";
        $rubrikList = array();

        $resultData = $this->dbConnect->query($sql);

        while ($obj = $resultData->fetch_object()) {
            $rubrikList[] = new Rubrik($obj->rubriknummer, $obj->rubrikbezeichnung);
        }

//        foreach ($rubrikList as $value) {
//            echo $value->getBezeichnung() . '</br>';
//            echo $value->getNummer() . '</br>';
//        }

        /* while($row = $resultData->fetch_array(MYSQLI_ASSOC)){
          $rubrikList[] = new Rubrik($row["rubriknummer"], $row["rubrikbezeichnung"]);
          } */
        $resultData->free();

        return $rubrikList;
    }

    public function update(Rubrik $rubrik) {

    }

    public function delete($nummer) {

    }

    public function __destruct() {
        //$this->dbConnect->close();
    }

}
