<?php

require 'inc/datenbank.php';
require 'inc/header.php';

$host = htmlspecialchars($_SERVER['HTTP_HOST']);
$uri = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), "/\\");
$extra = 'admin.php';

if ( !isset($_GET['id']) || !is_numeric($_GET['id']) ) {

    header("Location: http://$host$uri/$extra");

}

$id = $_GET['id'];

try {
    
    $sql = "DELETE FROM begriffe 
            WHERE id=:id";

    $stmt = $pdo->prepare($sql);   
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: http://$host$uri/$extra");

} catch(PDOException $e) {

     // Nicht in Live-Website ausgeben!
     die("FEHLER: Konnte folgenden Befehl nicht ausführen: $sql. " . $e->getMessage());

}
 
unset($stmt);
 
unset($pdo);

require 'inc/footer.php';