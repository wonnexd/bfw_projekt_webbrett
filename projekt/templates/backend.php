<?php
include 'includes/header.php';
?>

<?php
if (!isset($_SESSION['userid'])) {
    ?>

    <div class="container">
        <div class="row">

            <form action="input_handling.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        Titel einfügen <br>
                        <input type="text" size="40"  name="title" required><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating">
                            Text einfügen (maximal 320 Zeichen für den Text)
                            <textarea id='text' name='text' style='border: 1px solid black;'>
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h2>Bilder Hochladen</h2>
                        <label for="fileSelect">Filename:</label>
                        <input type="file" name="photo" id="fileSelect">

                        <p><strong>Note:</strong> Only .jpg, .jpeg, .gif, .png Formate erlaubt bis zu 5 MB.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Zu sehen bis einschließlich Tag x (optionale Eingabe)<br>
                        <input type="datetime-local" size="40" name="expiration_date"><br>
                    </div>
                </div>
                <input type="submit" name="submit" value="Erstellen">
            </form>

            <div class="mt-5">
                <div class="h2">Vorhandene Bilder für WYSIWYG</div>
                <div>Pfad einfach kopieren und einfügen</div>
                <?php
                if ($handle = opendir('../upload/')) {

                    while (false !== ($entry = readdir($handle))) {

                        if ($entry != "." && $entry != "..") {

                            echo "../upload/$entry\n";
                        }
                        echo '</br>';
                    }

                    closedir($handle);
                }
                ?>
            </div>

        </div>
    </div>

    <?php
} else {
    echo 'bitte einlogen <a href="login.php">Hier klicken</a>';
}
?>

<script type="text/javascript">
    // Initialize CKEditor
    CKEDITOR.replace('text', {
        height: "150px"
    });
</script>

<?php
include 'includes/footer.php';
