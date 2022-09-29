<?php
include '../classes/Rubrik.php';
include '../classes/Rubrikzugriff.php';

$dataobject = new Rubrikzugriff();
$alleRubriken = $dataobject->readAll();

include 'includes/header.php';
?>

<?php
if (!isset($_SESSION['userid'])) {
    ?>

    <div class="container">
        <div class="row">

            <form action="../controller/backendController.php" method="post">
                <div class="row">
                    <div class="col">
                        Nickname <br>
                        <input type="text" name="Nickname" required><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        E-Mailadresse <br>
                        <input type="email" name="E-Mailadresse" required><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Anzeigentext <br>
                        <input type="text" name="Anzeigentext" required><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4>Kategorie auswählen (max. 3)</h4>
                        <div>
                            <?php
                            foreach ($alleRubriken as $value) {
                                ?>
                                <input type="checkbox" name="check_list[]" id="box" onclick="checkBoxes()" value="<?php echo $value->getNummer() ?>">
                                <label for="<?php echo $value->getNummer() ?>">
                                    <?php
                                    echo $value->getBezeichnung();
                                    ?>
                                </label><br>
                                <?php
                            }
                            ?>
                            </br>
                            <input type="submit" value="erstellen">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        function checkBoxes() {
            if ((document.querySelectorAll('input[type="checkbox"]:checked').length) > 3) {
                alert('nur 3 Kategorien auswählen');
            }
        }
    </script>

    <?php
} else {
    echo 'bitte einlogen <a href="login.php">Hier klicken</a>';
}

include 'includes/footer.php';
