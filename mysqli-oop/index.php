<?php

require 'inc/datenbank.php';
require 'inc/header.php';

if ( $stmt = $mysqli->prepare('SELECT id, titel, text FROM begriffe') ) :

    $stmt->execute();
    $stmt->bind_result($id, $titel, $text);
    $stmt->store_result();

    if ($stmt->num_rows > 0) :

?>

    <table>

    <?php
    /*
        *Alternative Syntax ohne geschweifte Klammern

        Gut geeignet für sog. Templatecode, bei dem HTML  
        und PHP gemischt werden, weil der Abschluss von
        Schleifen und Verzweigungen besser sichtbar ist
    */

    // Solange $stmt->fetch() einen Wert zurückgibt
    while ( $stmt->fetch() ) :

        $titel = htmlspecialchars($titel);
        $text = htmlspecialchars($text);
        $id = (int) $id;

    ?>
        
        <tr>
            <th><?php echo $titel; ?></th>
            <td><?php echo $text; ?></td>
        </tr>

    <?php

    endwhile; 

    $stmt->close();

    ?>

    </table>
        
<?php

    endif;

endif;

require 'inc/footer.php';

?>