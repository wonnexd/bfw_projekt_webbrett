<?php
include '../classes/Rubrik.php';
include '../classes/Rubrikzugriff.php';

$dataobject = new Rubrikzugriff();
$alleRubriken = $dataobject->readAll();

include 'includes/header.php';
?>

<form method="post" action="alleAnzeigen.php">
    <table class="table table-hover">
        <thead class="bg-blue text-light">
            <tr>
                <th scope="col">
                    <div class="p-2">
                        Rubrik
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($alleRubriken as $value) {
                echo '<tr><td><button type="submit" class="btn button-color" value="' . $value->getBezeichnung() . '" name="rubrik">' . $value->getBezeichnung() . '</button></td></tr>';
            }
            ?>
        </tbody>
    </table>
</form>

<?php
include 'includes/footer.php';
