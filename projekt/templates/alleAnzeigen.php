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

<table class="table table-striped table-hover">
    <thead class="bg-blue text-light">
        <tr>
            <th scope="col">Titel</th>
            <th scope="col">Autor</th>
            <th scope="col">Verlag</th>
            <th scope="col">ISBN</th>
            <th scope="col">Inserent</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($alleAnzeigen as $value) {
            echo '<tr><td>' . $value->getTitel() . '</td><td>' . $value->getAutor() . '</td><td>' . $value->getVerlag() . '</td><td>' . $value->getIsbn() . '</td><td>' . $value->getInserent()->getNickname() . ' ~ Email: ' . $value->getInserent()->getEmail() . '</td></tr>';
        }
        ?>
    </tbody>
</table>

<?php
include 'includes/footer.php';
