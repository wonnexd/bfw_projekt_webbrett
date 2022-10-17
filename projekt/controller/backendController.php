<?php

include '../templates/includes/header.php';

include '../classes/Anzeige.php';
include '../classes/Anzeigezugriff.php';
include '../classes/Inserent.php';
include '../classes/Inserentzugriff.php';
include '../classes/Veroeffentlichenzugriff.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nickname = $_POST['Nickname'];
    $Emailadresse = $_POST['E-Mailadresse'];
    $titel = $_POST['titel'];
    $autor = $_POST['autor'];
    $verlag = $_POST['verlag'];
    $isbn = $_POST['isbn'];
    $check_list = $_POST['check_list'];
}

$counter = 0;
foreach ($_POST['check_list'] as $check) {
    $counter += 1;
}
if ($counter > 3) {
    echo 'nur 3 Kategorien auswählen';
} elseif ($counter == 0) {
    echo 'keine Kategorie ausgewählt';
} elseif ($counter <= 3 and $counter > 0) {
    $inserentObject = new Inserentzugriff();
    $anzeigenObject = new Anzeigezugriff();
    $veroeffentlichenObject = new VeroeffentlichenZugriff();

    $returnValue = $inserentObject->create(null, $Nickname, $Emailadresse);
    $inserentenNummer = $returnValue[0];
    $error = $returnValue[1];

    if ($error == false) {
        $anzeigenNummer = $anzeigenObject->create(null, $inserentenNummer, $titel, $autor, $verlag, $isbn, date("Y-m-d"));

        foreach ($_POST['check_list'] as $check) {
            $veroeffentlichenObject->createVeroeffentlichen($anzeigenNummer, $check);
        }
        header("location: ../templates/index.php");
    }
}

include '../templates/includes/footer.php';
