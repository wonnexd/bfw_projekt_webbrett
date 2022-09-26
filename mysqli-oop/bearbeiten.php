<?php

// Verbindung zur Datenbank herstellen
require 'inc/datenbank.php';
// HTML für den Kopfbereich der Anwendung einbinden
require 'inc/header.php';
// Den Host speichern -> hier: localhost
$host = htmlspecialchars($_SERVER['HTTP_HOST']);
/*
    Das aktuelle Verzeichnis speichern 
    Dateiname und -endung werden mit dirname() entfernt
    Eventuelle Slashes (/) oder Backslashes (\) werden entfernt
*/
$uri = rtrim(dirname($_SERVER['PHP_SELF']), "/\\");
// Die neue Dateiendung wird festgelegt
$extra = 'admin.php';

// Wenn das superglobale Array $_GET einen Wert für den Schlüssel id enthält
if ( isset($_GET['id']) ) {
    
    $id = $_GET['id'];
    $sql = 'SELECT id, titel, text FROM begriffe WHERE id=?';

    // Wenn es möglich ist, den SQL Code für die Ausführung vorzubereiten (Probelauf)
    if ( $stmt = $mysqli->prepare($sql) ) {
        /*
            Bindet Variablen als Parameter an eine vorbereitete Anweisung (Prepared Statement)
            i gibt an, dass ein Integerwert erwartet wird
        */
        $stmt->bind_param('i', $id);
        // Das Prepared Statement tatsächlich ausführen
        $stmt->execute();
        // Stellt Variablen zum Speichern der Datenbankabfrage zur Verfügung
        $stmt->bind_result($id, $titel, $text);
        /*
            Speichert die Ergebnisse eines Prepared Statements in die mit bind_result() 
            zur Verfügung gestellten (gebundenen) Variablen

            $stmt->store_result() hier nicht notwendig, 
            da nur ein Datensatz ausgelesen wird 
        */
        $stmt->fetch();
        // Schließt das Prepared Statement und gibt das Handle ($stmt) frei
        $stmt->close();

        $titel = htmlspecialchars($titel);
        $text = htmlspecialchars($text);
        $id = (int) $id;

    }

} 

/*
    Wenn das superglobale Array $_SERVER für den Schlüssel "REQUEST_METHOD" den Wert "POST" enthält
    Dies ist der Fall, wenn das u.s. Formular abgesendet wurde 
*/
if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {

    $sql = 'UPDATE begriffe SET titel=?, text=? WHERE id=?';

    if ( $stmt = $mysqli->prepare($sql) ) {

        // Wert aus dem Formular übernehmen
        $titel = $_POST['titel'];
        // Wert aus dem Formular übernehmen
        $text = $_POST['text'];
        /*
            Bindet Variablen als Parameter an eine vorbereitete Anweisung (Prepared Statement)
            i gibt an, dass ein Integerwert (Ganzzahl) erwartet wird
            s gibt an, dass ein String erwartet wird
            d gibt an, dass ein Doublewert (Fließkommazahl) erwartet wird
        */
        $stmt->bind_param('ssi', $titel, $text, $id);
        
        $stmt->execute();
        $mysqli->close();
        header("Location: http://$host$uri/$extra");

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

?>