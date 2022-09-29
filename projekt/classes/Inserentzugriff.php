<?php

class Inserentzugriff {

    private $dbConnect;

    public function __construct() {
        $this->dbConnect = new mysqli('localhost', 'root', '', 'webbrett');
    }

    public function create($inserentennummer, $nickname, $email) {

        $error = false;
        $userExists = false;

        $sql = "SELECT email, inserentennummer from inserent where nickname = ?";

        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bind_param("s", $nickname);
        $stmt->execute();
        $result1 = $stmt->get_result();

        while ($obj = $result1->fetch_object()) {
            $comparisonEmail = $obj->email;
            $id = $obj->inserentennummer;
        }
        if ($comparisonEmail) {
            $userExists = true;
            if ($comparisonEmail != $email) {
                $error = true;
                echo 'Nickname mit anderer EMailadresse schon eingetragen';
            }
        }

        $sql = "SELECT nickname from inserent where email = ?";

        $stmt = $this->dbConnect->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result2 = $stmt->get_result();

        while ($obj = $result2->fetch_object()) {
            $comparisonNickname = $obj->nickname;
        }
        if ($comparisonNickname) {
            if ($comparisonNickname != $nickname) {
                $error = true;
                echo 'für eine vorhandene E-Mailadresse kann kein weiterer Nickname angegeben werden';
            }
        }

        if ($error == false and $userExists == false) {
            $sql = 'INSERT INTO inserent (inserentennummer, nickname, email) VALUES (?, ?, ?)';

            $stmt = $this->dbConnect->prepare($sql);
            $stmt->bind_param("iss", $inserentennummer, $nickname, $email);
            $stmt->execute();

            $id = $stmt->insert_id;

            $this->dbConnect->close();
        }

        return [$id, $error];
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
        $sql = "SELECT inserentennummer , nickname, email FROM inserent";
        $inserentList = array();

        $resultData = $this->dbConnect->query($sql);

        while ($obj = $resultData->fetch_object()) {
            $inserentList[] = new Inserent($obj->inserentennummer, $obj->nickname, $obj->email);
        }

//        foreach ($rubrikList as $value) {
//            echo $value->getBezeichnung() . '</br>';
//            echo $value->getNummer() . '</br>';
//        }

        /* while($row = $resultData->fetch_array(MYSQLI_ASSOC)){
          $rubrikList[] = new Rubrik($row["rubriknummer"], $row["rubrikbezeichnung"]);
          } */
        $resultData->free();

        return $inserentList;
    }

    public function update(Rubrik $rubrik) {

    }

    public function delete($nummer) {

    }

    public function __destruct() {
        //$this->dbConnect->close();
    }

}
