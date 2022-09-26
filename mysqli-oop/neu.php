<?php

require 'inc/datenbank.php';
require 'inc/header.php';

$host = htmlspecialchars($_SERVER['HTTP_HOST']);
$uri = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), "/\\");
$extra = 'admin.php';

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {

    if ( $stmt = $mysqli->prepare('INSERT INTO begriffe (titel, text) VALUES (?, ?)') ) {

        $titel = $_POST['titel'];
        $text = $_POST['text'];

        $stmt->bind_param('ss', $titel, $text);
        $stmt->execute();
        $stmt->close();

        $mysqli->close();
        
        header("Location: http://$host$uri/$extra");

    }

}

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div>
        <label for="titel">Titel </label>
        <br>
        <input type="text" name="titel" id="titel" maxlength="25">
    </div>

    <div>
        <label for="text">Text </label>
        <br>
        <textarea name="text" id="text"></textarea>
    </div>
    <input type="submit" value="Eintragen">
</form>

<?php

require 'inc/footer.php';

?>