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

            <div class="col-md-1 col-lg-3">
            </div>

            <div class="col-md-10 col-lg-6">
                <form action="../controller/backendController.php" method="post">
                    <div class="row">
                        <div class="col">
                            Nickname <br>
                            <input type="text" name="Nickname" class="form-control" required><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            E-Mailadresse <br>
                            <input type="email" name="E-Mailadresse" class="form-control" required><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            Titel <br>
                            <input type="text" name="titel" class="form-control" required><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            Autor <br>
                            <input type="text" name="autor" class="form-control" required><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            ISBN <br>
                            <input type="number" name="isbn" class="form-control" required><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            Verlag <br>
                            <input type="text" name="verlag" class="form-control" required><br>
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

            <div class="col-md-1 col-lg-3">
            </div>

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
