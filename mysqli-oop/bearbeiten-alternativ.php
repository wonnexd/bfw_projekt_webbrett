<?php

require 'inc/datenbank.php';
require 'inc/header.php';

?>

<?php

$host = htmlspecialchars($_SERVER['HTTP_HOST']);
$uri = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), "/\\");
$extra = 'anzeigen.php';

if ( !isset($_GET['id']) || !is_numeric($_GET['id']) ) {

    header("Location: http://$host$uri/$extra");

}

if ( empty($_POST['titel']) ) {

    $id = $_GET['id'];
    $sql = 'SELECT id, titel, text FROM begriffe WHERE id=?';
    
    if ( $stmt = $mysqli->prepare($sql) ) {

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($id, $titel, $text);
        $stmt->fetch();
        $stmt->close();

        $mysqli->close();

        $titel = htmlspecialchars($titel);
        $text = htmlspecialchars($text);
        $id = (int) $id;

?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="titel">Titel</label>
            <input type="text" name="titel" id="titel" maxlength="25"
                   value="<?php echo $titel; ?>">
            <label for="text">Beschreibung</label>
            <textarea name="text" id="text" rows="5" cols="30"><?php echo $text; ?>
            </textarea>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Eintragen">
        </form>

<?php

    } else {

        $id = (int) $_POST['id'];
        $sql = 'UPDATE begriffe SET titel=?, text=? WHERE id=?';

        if ( $stmt = $mysqli->prepare($sql) ) {

            $titel = $_POST['titel'];
            $text = $_POST['text'];
            $stmt->bind_param('ssi', $titel, $text, $id);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
            header("Location: http://$host$uri/$extra");

        }

    }

}

?>

<?php

require 'inc/footer.php';

?>