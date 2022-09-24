<?php
include '../classes/Anzeige.php';
include '../classes/Anzeigezugriff.php';

$dataobject = new Anzeigezugriff();
$dataobject->readAll();
$alleAnzeigen = $dataobject->readAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rubrik = $_POST['rubrik'];
}

include 'includes/header.php';
?>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Rubrik</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $counter = 0;
        foreach ($alleAnzeigen as $value) {
            echo '<tr><td><button type="button" name="' . $value->getNummer() . '" class="btn btn-primary">' . $value->getText() . '</button></td></tr>';
        }
        ?>
    </tbody>
</table>

<?php
include 'includes/footer.php';
