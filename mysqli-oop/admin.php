<?php

// Verbindung zur Datenbank herstellen
require 'inc/datenbank.php';
// HTML für den Kopfbereich der Anwendung einbinden
require 'inc/header.php';

// Wenn es möglich ist, den SQL Code für die Ausführung vorzubereiten (Probelauf)
if ( $stmt = $mysqli->prepare('SELECT id, titel, text FROM begriffe') ) :

    // Das Prepared Statement tatsächlich ausführen
    $stmt->execute();
    // Stellt Variablen zum Speichern der Datenbankabfrage zur Verfügung
    $stmt->bind_result($id, $titel, $text);
    /*
        Alle Ergebnisse der Datenbankabfrage zwischenspeichern (muss genutzt werden,
        wenn mehr als ein Datensatz (Zeile aus der Tabelle) ausgelesen wird)
    */
    $stmt->store_result();
    // Wenn die Datenbankabfrage Datensätze (Zeilen aus der Tabelle) zurückliefert
    if ( $stmt->num_rows > 0 ) :   

?>

    <table>

        <?php

        /*
            Speichert die Ergebnisse eines Prepared Statements in die mit bind_result() 
            zur Verfügung gestellten (gebundenen) Variablen
        */
        while ( $stmt->fetch() )  :
            /*
                Sonderzeichen aus Sicherheitsgründen in HTML Entities umwandeln 
                z.B. < in &lt;
                Dies verhindert, dass ungewollt HTML-Tags ausgegeben werden.
                z.B. <script>alert('Sie wurden gehackt')</script>
            */
            $titel = htmlspecialchars($titel);
            $text = htmlspecialchars($text);
            // Id in Ganzzahl umwandeln
            $id = (int) $id;

        ?>

        <tr>
            <th><?php echo $titel; ?></th>
            <td><?php echo $text; ?></td>
            <td>
                <!-- 
                    Die Id des Datensatzes an die URL anhängen,
                    um in der Datei bearbeiten.php den ausgewählten 
                    Datensatz zu bearbeiten 
                 -->
                <a href="bearbeiten.php?id=<?php echo $id; ?>" >bearbeiten</a>
            </td>
            <td>
                <a href="loeschen.php?id=<?php echo $id; ?>" onclick="return confirm('Wollen Sie den Eintrag wirklich löschen?')">löschen</a>
            </td>
        </tr>

        <?php

        endwhile;

        $stmt->close();

        ?>

    </table>

<?php

    endif;

endif;

// Datenbankverbindung schließen
$mysqli->close();

?>

<p><a href="neu.php">Neue Begriffe eintragen</a></p>

<?php

// HTML für den Fußbereich der Anwendung einbinden
require 'inc/footer.php';

?>