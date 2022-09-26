<?php

try {

    $pdo = new PDO('mysql:host=localhost;dbname=crud-app', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $meldung = 'Verbindung zur Datenbank erfolgreich.';

} catch(PDOException $e) {

    die('Keine Verbindung zur Datenbank möglich.');
    
}