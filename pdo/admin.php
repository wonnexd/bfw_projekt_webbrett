<?php

// Verbindung zur Datenbank herstellen
require 'inc/datenbank.php';
// HTML für den Kopfbereich der Anwendung einbinden
require 'inc/header.php';

try {
    
    $sql = "SELECT id, titel, text 
            FROM begriffe";
    
    $ergebnisse = $pdo->query($sql, PDO::FETCH_ASSOC);

    if ($ergebnisse->rowCount() > 0) :

?>

    <table>

    <?php

    foreach ( $ergebnisse as $begriff ) :

        $titel = htmlspecialchars($begriff['titel']);
        $text = htmlspecialchars($begriff['text']);
        $id = (int) $begriff['id'];

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

    <?php endforeach; ?>

    </table>
    
    <p><a href="neu.php">Neuen Begriff eintragen</a></p> 

<?php

else : 

    echo "Keine Einträge gefunden.";

endif;

} catch(PDOException $e) {

    // Nicht in Live-Website ausgeben!
    die("FEHLER: Konnte folgenden Befehl nicht ausführen: $sql. " . $e->getMessage());

}

unset($ergebnisse);

unset($pdo);

require 'inc/footer.php';