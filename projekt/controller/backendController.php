<?php

include '../classes/Anzeige.php';
include '../classes/Anzeigezugriff.php';
include '../classes/Inserent.php';
include '../classes/Inserentzugriff.php';
include '../classes/Veroeffentlichenzugriff.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nickname = $_POST['Nickname'];
    $Emailadresse = $_POST['E-Mailadresse'];
    $Anzeigentext = $_POST['Anzeigentext'];
    $check_list = $_POST['check_list'];
}

$inserentObject = new Inserentzugriff();
$anzeigenObject = new Anzeigezugriff();
$inserentenNummer = $inserentObject->create(null, $Nickname, $Emailadresse);
$anzeigenNummer = $anzeigenObject->create(null, $inserentenNummer, $Anzeigentext, date("Y-m-d"));
$veroeffentlichenObject = new VeroeffentlichenZugriff();

foreach ($_POST['check_list'] as $check) {
    $veroeffentlichenObject->createVeroeffentlichen($anzeigenNummer, $check);
}

header("Location: ../templates/index.php");
