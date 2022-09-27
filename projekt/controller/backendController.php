<?php

include '../classes/Anzeige.php';
include '../classes/Anzeigezugriff.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nickname = $_POST['Nickname'];
    $Emailadresse = $_POST['E-Mailadresse'];
    $Anzeigentext = $_POST['Anzeigentext'];
    $check_list = $_POST['check_list'];

    foreach ($_POST['check_list'] as $check) {
        $check;
    }
}

$objectAnzeige = new Anzeige(null, 'dsadsa');
echo $objectAnzeige->getNummer();
//$objectInserent = new Inserent();

//private $nickname;
//private $email;
//
//private $nummer;
//private $text;
//private $datum;
//private $inserent;
//private $inserentennummer;

//create($Nickname, $Emailadresse, $Anzeigentext, $check_list);

//header("Location: http://$host$uri/$extra");