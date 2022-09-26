<?php

require 'inc/datenbank.php';
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
        </tr>

    <?php endforeach; ?>

    </table>
        
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