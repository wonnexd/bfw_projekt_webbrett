<?php
include '../classes/Anzeige.php';
include '../classes/Anzeigezugriff.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rubrik = $_POST['rubrik'];
}

$dataobject = new Anzeigezugriff();
$alleAnzeigen = $dataobject->read($rubrik);

foreach ($alleAnzeigen as $array) {
    insertInserent($array);
}

include 'includes/header.php';
?>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Rubrik</th>
            <th scope="col">Inserent</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $counter = 0;
        foreach ($alleAnzeigen as $value) {
            echo '<tr><td><button type="button" name="' . $value->getNummer() . '" class="btn button-color">' . $value->getText() . 'hallo' . $value->getNummer() . '</button></td></tr>';
        }
        ?>
    </tbody>
</table>

<?php
include 'includes/footer.php';
