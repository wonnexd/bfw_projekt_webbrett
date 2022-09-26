<?php

require 'inc/datenbank.php';
require 'inc/header.php';

$host = htmlspecialchars($_SERVER['HTTP_HOST']);
/*
    Das aktuelle Verzeichnis speichern 
    Dateiname und -endung werden mit dirname() entfernt
    Eventuelle Forwardslashes (/) oder Backslashes (\) werden entfernt
*/
$uri = rtrim(dirname($_SERVER['PHP_SELF']), "/\\");
$extra = 'admin.php'; 

if ( isset($_GET['id']) ) {

    $id = $_GET['id'];

    try {

        $sql = "SELECT id, titel, text 
                FROM begriffe 
                WHERE id=:id";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        $ergebnis = $stmt->fetch(PDO::FETCH_ASSOC);

        $titel = htmlspecialchars($ergebnis['titel']);
        $text = htmlspecialchars($ergebnis['text']);
        $id = (int) $ergebnis['id'];

    } catch(PDOException $e) {

        // Nicht in Live-Website ausgeben!
        die("FEHLER: Konnte folgenden Befehl nicht ausführen: $sql. " . $e->getMessage());
        
    }

} 

if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {

    try {
    
        $sql = "UPDATE begriffe 
                SET titel=:titel, text=:beschreibung
                WHERE id=:id";

        $titel = $_POST['titel'];
        $beschreibung = $_POST['text'];
    
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':titel', $titel, PDO::PARAM_STR);
        $stmt->bindParam(':beschreibung', $beschreibung, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        header("Location: http://$host$uri/$extra");
    
    } catch(PDOException $e) {
    
         // Nicht in Live-Website ausgeben!
         die("FEHLER: Konnte folgenden Befehl nicht ausführen: $sql. " . $e->getMessage());
    
    }

}

?>

<form method="post" action="">
    <div>
        <label for="titel">Titel</label>
        <br>
        <input type="text" name="titel" id="titel" value="<?php echo $titel; ?>">
    </div>
    <div>
        <label for="text">Beschreibung</label>
        <br>
        <textarea name="text" id="text"><?php echo $text; ?></textarea>
    </div>
    <input type="submit" value="Eintragen">
</form>

<?php

// HTML für den Fußbereich der Anwendung einbinden
require 'inc/footer.php';