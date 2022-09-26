<?php

require 'inc/datenbank.php';
require 'inc/header.php';

$host = htmlspecialchars($_SERVER['HTTP_HOST']);
$uri = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), "/\\");
$extra = 'admin.php';

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {

    try {

        $titel = $_POST['titel'];
        $text = $_POST['text'];

        $sql = "INSERT INTO begriffe (titel, text) 
                VALUES (:titel, :text)";
    
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':titel', $titel, PDO::PARAM_STR);
        $stmt->bindParam(':text', $text, PDO::PARAM_STR);

        $stmt->execute();
        
        echo "Eintrag erolgreich hinzugefügt";

        header("Location: http://$host$uri/$extra");
    
    } catch(PDOException $e) {
    
            // Nicht in Live-Website ausgeben!
            die("FEHLER: Konnte folgenden Befehl nicht ausführen: $sql. " . $e->getMessage());
    
    }
         
    unset($stmt);
        
    unset($pdo);

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