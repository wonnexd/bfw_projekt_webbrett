<?php
include '../classes/Anzeige.php';
include '../classes/Anzeigezugriff.php';
include '../classes/Inserent.php';
include '../classes/Inserentzugriff.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rubrik = $_POST['rubrik'];
}

$dataobject = new Anzeigezugriff();
$alleAnzeigen = $dataobject->read($rubrik);
$dataobject2 = new Inserentzugriff();
$alleInserenten = $dataobject2->readAll();
$dataobject->insertInserent($alleInserenten, $alleAnzeigen);

include 'includes/header.php';
?>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Anzeige</th>
            <th scope="col">Inserent</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $counter = 0;
        foreach ($alleAnzeigen as $value) {
            echo '<tr><td><button type="button" name="' . $value->getNummer() . '" class="btn button-color">' . $value->getText() . ' ' . $value->getNummer() . '</button></td><td><button type="button" name="' . $value->getNummer() . '" class="btn button-color">' . $value->getInserent()->getNickname() . ' ' . $value->getInserent()->getEmail() . '</button></td></tr>';
        }
        ?>
    </tbody>
</table>

<?php
include 'includes/footer.php';
